<?php
class FusionSC_GoogleMap {

	private $map_id;

	public static $args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'fusion_attr_google-map-shortcode', array( $this, 'attr' ) );
		add_shortcode( 'map', array( $this, 'render' ) );

	}

	/**
	 * Render the shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render( $args, $content = '' ) {
		global $smof_data;

		$defaults = FusionCore_Plugin::set_shortcode_defaults(
			array(
				'class'						=> '',
				'id'						=> '',
				'animation'					=> 'no',
				'address'					=> '',
				'height'					=> '300px',				
				'icon'						=> '',
				'infobox'					=> '',
				'infobox_background_color'	=> '',
				'infobox_content'			=> '',
				'infobox_text_color'		=> '',
				'map_style'					=> '',
				'overlay_color'				=> '',
				'popup'						=> 'yes',
				'scale'						=> 'yes',				
				'scrollwheel'				=> 'yes',				
				'type'						=> 'roadmap',
				'width'						=> '100%',
				'zoom'						=> '14',
				'zoom_pancontrol'			=> 'yes',
			), $args
		);

		extract( $defaults );

		self::$args = $defaults;

		$html = '';

		if( $address ) {
			$addresses = explode( '|', $address );

			if( $infobox_content ) {
				$infobox_content_array = explode( '|', $infobox_content );
			} else {
				$infobox_content_array = '';
			}
			
			if( $icon ) {
				$icon_array = explode( '|', $icon );
			} else {
				$icon_array = '';
			}		

			if( $addresses ) {
				self::$args['address'] = $addresses;
			}
			
			$num_of_addresses = count( $addresses );
		
			if( $map_style == 'theme' ) {
				$map_style = 'custom';
				$icon = 'theme';
				$animation = 'yes';
				$infobox = 'custom';
				$infobox_background_color = FusionCore_Plugin::hex2rgb( $smof_data['primary_color'] );
				$infobox_background_color = 'rgba(' . $infobox_background_color[0] . ', ' . $infobox_background_color[1] . ', ' . $infobox_background_color[2] . ', 0.8)';
				$overlay_color = $smof_data['primary_color'];
				$brightness_level = FusionCore_Plugin::calc_color_brightness( $smof_data['primary_color'] );

				if( $brightness_level > 140 ) {
					$infobox_text_color = '#fff';
				} else {
					$infobox_text_color = '#747474';
				}				
			}

			if( $map_style == 'custom' ) {
				$animation = 'yes';
			}
			
			if( $icon == 'theme' && $map_style == 'custom' ) {
				for( $i = 0; $i < $num_of_addresses; $i++ ) {
					$icon_array[$i] = plugins_url( 'images/avada_map_marker.png', dirname( __FILE__ ) );				
				}
			}			

			wp_print_scripts( 'google-maps-api' );
			wp_print_scripts( 'google-maps-infobox' );

			foreach( self::$args['address'] as $add ) {

				$coordinates[] = $this->get_coordinates( $add );
			}

			if( ! is_array( $coordinates ) ) {
				return;
			}
			
			for( $i = 0; $i < $num_of_addresses; $i++ ) {
				if( strpos( self::$args['address'][$i], 'latlng=' ) === 0 ) {
					self::$args['address'][$i] = $coordinates[$i]['address'];
				}
			}
			
			if( is_array( $infobox_content_array ) && 
				! empty( $infobox_content_array ) 
			) {
				for( $i = 0; $i < $num_of_addresses; $i++ ) {
					if( ! array_key_exists( $i, $infobox_content_array ) ) {
						$infobox_content_array[$i] = self::$args['address'][$i];
					}
				}
				self::$args['infobox_content'] = $infobox_content_array;
			} else {
				self::$args['infobox_content'] = self::$args['address'];
			}			

			$map_id = uniqid( 'fusion_map_' ); // generate a unique ID for this map
			$this->map_id = $map_id;

			ob_start(); ?>
			<script type="text/javascript">
				var map_<?php echo $map_id; ?>;
				var markers = [];
				var counter = 0;
				function fusion_run_map_<?php echo $map_id ; ?>() {
					var location = new google.maps.LatLng(<?php echo $coordinates[0]['lat']; ?>, <?php echo $coordinates[0]['lng']; ?>);
					var map_options = {
						zoom: <?php echo $zoom; ?>,
						center: location,
						mapTypeId: google.maps.MapTypeId.<?php echo strtoupper($type); ?>,
						scrollwheel: <?php echo ($scrollwheel == 'yes') ? 'true' : 'false'; ?>,
						scaleControl: <?php echo ($scale == 'yes') ? 'true' : 'false'; ?>,
						panControl: <?php echo ($zoom_pancontrol == 'yes') ? 'true' : 'false'; ?>,
						zoomControl: <?php echo ($zoom_pancontrol == 'yes') ? 'true' : 'false'; ?>						
					};
					map_<?php echo $map_id ; ?> = new google.maps.Map(document.getElementById("<?php echo esc_attr( $map_id ); ?>"), map_options);
					<?php $i = 0; ?>
					<?php
					foreach( $coordinates as $key => $coordinate ):
						$infobox_content = trim( self::$args['infobox_content'][$key] );
						$infobox_content_arr = explode( "\n", $infobox_content );
						$infobox_content_arr = array_filter( $infobox_content_arr, 'trim' );
						$infobox_content = implode( '', $infobox_content_arr );
						$infobox_content = str_replace( "\r", '', $infobox_content );
						$infobox_content = str_replace( "\n", '', $infobox_content );
					?>
					
					var content_string = "<div class='info-window'><?php echo $infobox_content; ?></div>";
					
					<?php if( $overlay_color && $map_style == 'custom' ) { 
					$hsl = FusionCore_Plugin::rgb2hsl( $overlay_color );
					?>
					var styles = [
					  {
						stylers: [
						  { hue: '<?php echo $overlay_color; ?>' },
						  <?php if( self::$args['map_style'] == 'custom' ): ?>
						  { saturation: '<?php echo $hsl['sat'] * 2 - 100; ?>' },
						  { lightness: '<?php echo $hsl['lum'] * 2 - 100; ?>' }
						  <?php elseif( self::$args['map_style'] == 'theme' ): ?>
						  { saturation: '-20' },
						  <?php endif; ?>
						]
					  },{
						featureType: "road",
						elementType: "geometry",
						stylers: [
						  { visibility: "simplified" }
						]
					  },{
						featureType: "road",
						elementType: "labels",
					  }
					];					

					map_<?php echo $map_id ; ?>.setOptions({styles: styles});
					
					<?php } ?>

					map_<?php echo $map_id ; ?>_args = {
						position: new google.maps.LatLng("<?php echo $coordinate['lat']; ?>", "<?php echo $coordinate['lng']; ?>"),
						map: map_<?php echo $map_id ; ?>
					};

					<?php if ( $animation == 'yes' ) { ?>
					map_<?php echo $map_id ; ?>_args.animation = google.maps.Animation.DROP;
					<?php } ?>
					<?php if( $icon == 'theme' && isset( $icon_array[$i] ) && $icon_array[$i] && $map_style == 'custom' ) { ?>
					map_<?php echo $map_id ; ?>_args.icon = new google.maps.MarkerImage( '<?php echo $icon_array[$i]; ?>', null, null, null, new google.maps.Size( 37, 55 ) );
					<?php } else if( isset( $icon_array[$i] ) && $icon_array[$i] && $map_style == 'custom' ) { ?>
					map_<?php echo $map_id ; ?>_args.icon = '<?php echo $icon_array[$i]; ?>';
					<?php } ?>
					<?php $i++; ?>

					markers[counter] = new google.maps.Marker(map_<?php echo $map_id ; ?>_args);
					
					<?php if ( $infobox == 'custom' && $map_style == 'custom' ) { ?>
					
						var info_box_div = document.createElement('div');
						info_box_div.className = 'fusion-info-box';
						info_box_div.style.cssText = 'background-color:<?php echo $infobox_background_color; ?>;color:<?php echo $infobox_text_color; ?>;';

						info_box_div.innerHTML = content_string;

						var info_box_options = {
							 content: info_box_div
							,disableAutoPan: false
							,maxWidth: 150
							,pixelOffset: new google.maps.Size(-125, 10)
							,zIndex: null
							,boxStyle: { 
							  background: 'none'
							  ,opacity: 1
							  ,width: "250px"
							 }
							,closeBoxMargin: "2px 2px 2px 2px"
							,closeBoxURL: "<?php echo is_ssl() ? 'https' : 'http';?>://www.google.com/intl/en_us/mapfiles/close.gif"
							,infoBoxClearance: new google.maps.Size(1, 1)

						};

						markers[counter]['infowindow'] = new InfoBox(info_box_options);
						markers[counter]['infowindow'].open(map_<?php echo $map_id ; ?>, markers[counter]);
						<?php if( $popup != 'yes' ) { ?>
							markers[counter]['infowindow'].setVisible( false );
						<?php } ?>
						google.maps.event.addListener(markers[counter], 'click', function() {
							if( this['infowindow'].getVisible() ) {
								this['infowindow'].setVisible( false );
							} else {
								this['infowindow'].setVisible( true );
							}
						}); 					
						
					<?php } else { ?>
					
						markers[counter]['infowindow'] = new google.maps.InfoWindow({
							content: content_string
						});					
						
						<?php if( $popup == 'yes' ) { ?>
							markers[counter]['infowindow'].show = true;
							markers[counter]['infowindow'].open(map_<?php echo $map_id ; ?>, markers[counter]);
						<?php } ?>						

						google.maps.event.addListener(markers[counter], 'click', function() {
							if(this['infowindow'].show) {
								this['infowindow'].close(map_<?php echo $map_id ; ?>, this);
								this['infowindow'].show = false;
							} else {
								this['infowindow'].open(map_<?php echo $map_id ; ?>, this);
								this['infowindow'].show = true;
							}
						});
					
					<?php } ?>
					
					counter++;
					<?php endforeach; ?>

				}

				google.maps.event.addDomListener(window, 'load', fusion_run_map_<?php echo $map_id ; ?>);

			</script>
			<?php
			if( $defaults['id'] ) {
				$html = ob_get_clean() . sprintf( '<div id="%s"><div %s></div></div>', $defaults['id'], FusionCore_Plugin::attributes( 'google-map-shortcode' ) );
			} else {
				$html = ob_get_clean() . sprintf( '<div %s></div>', FusionCore_Plugin::attributes( 'google-map-shortcode' ) );
			}

		}

		return $html;

	}

	function attr() {
	
		$attr['class'] = 'shortcode-map fusion-google-map';

		if( self::$args['class'] ) {
			$attr['class'] .= ' ' . self::$args['class'];
		}

		$attr['id'] = $this->map_id;
		
		$attr['style'] = sprintf('height:%s;width:%s;',  self::$args['height'], self::$args['width'] );

		return $attr;

	}

	function get_coordinates( $address, $force_refresh = false ) {
		global $smof_data;

		$key = $smof_data['google_console_api_key'];

		$address_hash = md5( $address );

		$coordinates = get_transient( $address_hash );

		if ( $force_refresh || 
			 $coordinates === false
		) {

			if( strpos( $address, 'latlng=' ) === 0 ) {
				$args = array( 'latlng' => urlencode( substr( $address, 7 ) ), 'sensor' => 'false' );
			}else {
				$args = array( 'address' => urlencode( $address ), 'sensor' => 'false' );
			}

			$url = 'http://maps.googleapis.com/maps/api/geocode/json';
			if( $key ) {
				$args['key'] = $key;
				$url = 'https://maps.googleapis.com/maps/api/geocode/json';
			}
			$url		= add_query_arg( $args, $url );
		 	$response 	= wp_remote_get( $url );

		 	if( is_wp_error( $response ) )
		 		return;

		 	$data = wp_remote_retrieve_body( $response );

		 	if( is_wp_error( $data ) )
		 		return;

			if ( $response['response']['code'] == 200 ) {

				$data = json_decode( $data );

				if ( $data->status === 'OK' ) {

				  	$coordinates = $data->results[0]->geometry->location;

				  	$cache_value['lat'] 	= $coordinates->lat;
				  	$cache_value['lng'] 	= $coordinates->lng;
				  	$cache_value['address'] = (string) $data->results[0]->formatted_address;

				  	// cache coordinates for 3 months
				  	set_transient($address_hash, $cache_value, 3600*24*30*3);
				  	$data = $cache_value;

				} elseif ( $data->status === 'ZERO_RESULTS' ) {
				  	return __( 'No location found for the entered address.', 'fusion-core' );
				} elseif( $data->status === 'INVALID_REQUEST' ) {
				   	return __( 'Invalid request. Did you enter an address?', 'fusion-core' );
				} else {
					return __( 'Something went wrong while retrieving your map, please ensure you have entered the short code correctly.', 'fusion-core' );
				}

			} else {
			 	return __( 'Unable to contact Google API service.', 'fusion-core' );
			}

		} else {
		   // return cached results
		   $data = $coordinates;
		}

		return $data;

	}

}

new FusionSC_GoogleMap();
