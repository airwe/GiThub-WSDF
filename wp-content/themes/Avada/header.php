<!DOCTYPE html>
<html xmlns="http<?php echo (is_ssl())? 's' : ''; ?>://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<meta http-equiv="content-type" content="text/html; charset=US-ASCII" />
<meta http-equiv="content-language" content="en-us" />
<meta name="copyright" content="Copyright (c)2014-2018 
Ministry of Water & Environment. All Rights Reserved." />
<meta name="description" content="Water and Sanitation Development Facility." />
<meta name="keywords" content="WSDF, WSDF Uganda, Uganda, Water, Sanitation, Africa Water, East Africa water, Water and Sanitation Development Facility, Water schemes in Uganda, Ministry of Water & Environment, mwe.go.ug, wsdf.go.ug" />
<head>
	<?php
	if( isset( $_SERVER['HTTP_USER_AGENT'] ) &&
		( strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE' ) !== false )
	) {
		echo '<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />';
	}
	?>
	

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title>
	<?php
	if ( defined('WPSEO_VERSION') ) {
		wp_title('');
	} else {
		bloginfo('name'); ?> <?php wp_title(' - ', true, 'left');
	}
	?>
	</title>

	<?php global $smof_data, $woocommerce; ?>

	<!--[if lte IE 8]>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js"></script>
	<![endif]-->

	<?php
	if(is_page('header-2')) {
		$smof_data['header_right_content'] = 'Social Links';
		if($smof_data['scheme_type'] == 'Dark') {
			$smof_data['header_top_bg_color'] = '#29292a';
			$smof_data['snav_color'] = '#ffffff';
			$smof_data['header_top_first_border_color'] = '#3e3e3e';
		} else {
			$smof_data['header_top_bg_color'] = '#ffffff';
			$smof_data['snav_color'] = '#747474';
			$smof_data['header_top_first_border_color'] = '#efefef';
		}
	} elseif(is_page('header-3')) {
		$smof_data['header_right_content'] = 'Social Links';
		if($smof_data['scheme_type'] == 'Dark') {
			$smof_data['snav_color'] = '#747474';
			$smof_data['snav_color'] = '#bebdbd';
		} else {
			$smof_data['snav_color'] = '#ffffff';
			$smof_data['header_social_links_icon_color'] = '#ffffff';
		}
	} elseif(is_page('header-4')) {
		$smof_data['header_left_content'] = 'Social Links';
		if($smof_data['scheme_type'] == 'Dark') {
			$smof_data['snav_color'] = '#747474';
			$smof_data['snav_color'] = '#bebdbd';
		} else {
			$smof_data['snav_color'] = '#ffffff';
			$smof_data['header_social_links_icon_color'] = '#ffffff';
		}
		$smof_data['header_right_content'] = 'Navigation';
	} elseif(is_page('header-5')) {
		$smof_data['header_right_content'] = 'Social Links';
		if($smof_data['scheme_type'] == 'Dark') {
			$smof_data['snav_color'] = '#747474';
			$smof_data['snav_color'] = '#bebdbd';
		} else {
			$smof_data['snav_color'] = '#ffffff';
			$smof_data['header_social_links_icon_color'] = '#ffffff';
		}		
	}
	?>

	<?php $isiPad = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPad');
	if($smof_data['responsive']):
	if(!$isiPad || !$smof_data['ipad_potrait']):
	?>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<?php endif; endif; ?>

	<?php if($smof_data['favicon']): ?>
	<link rel="shortcut icon" href="<?php echo $smof_data['favicon']; ?>" type="image/x-icon" />
	<?php endif; ?>

	<?php if($smof_data['iphone_icon']): ?>
	<!-- For iPhone -->
	<link rel="apple-touch-icon-precomposed" href="<?php echo $smof_data['iphone_icon']; ?>">
	<?php endif; ?>

	<?php if($smof_data['iphone_icon_retina']): ?>
	<!-- For iPhone 4 Retina display -->
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $smof_data['iphone_icon_retina']; ?>">
	<?php endif; ?>

	<?php if($smof_data['ipad_icon']): ?>
	<!-- For iPad -->
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $smof_data['ipad_icon']; ?>">
	<?php endif; ?>

	<?php if($smof_data['ipad_icon_retina']): ?>
	<!-- For iPad Retina display -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $smof_data['ipad_icon_retina']; ?>">
	<?php endif; ?>

	<?php wp_head(); ?>

	<?php
	$object_id = get_queried_object_id();
	if((get_option('show_on_front') && get_option('page_for_posts') && is_home()) ||
		(get_option('page_for_posts') && is_archive() && !is_post_type_archive()) && !(is_tax('product_cat') || is_tax('product_tag')) || (get_option('page_for_posts') && is_search())) {
		$c_pageID = get_option('page_for_posts');
	} else {
		if(isset($object_id)) {
			$c_pageID = $object_id;
		}

		if(class_exists('Woocommerce')) {
			if(is_shop() || is_tax('product_cat') || is_tax('product_tag')) {
				$c_pageID = get_option('woocommerce_shop_page_id');
			}
		}
	}
	?>

	<!--[if lte IE 8]>
	<script type="text/javascript">
	jQuery(document).ready(function() {
	var imgs, i, w;
	var imgs = document.getElementsByTagName( 'img' );
	for( i = 0; i < imgs.length; i++ ) {
		w = imgs[i].getAttribute( 'width' );
		imgs[i].removeAttribute( 'width' );
		imgs[i].removeAttribute( 'height' );
	}
	});
	</script>
	
	<script src="<?php echo get_template_directory_uri(); ?>/js/excanvas.js"></script>
	
	<![endif]-->
	
	<!--[if lte IE 9]>
	<script type="text/javascript">
	jQuery(document).ready(function() {
	
	// Combine inline styles for body tag
	jQuery('body').each( function() {	
		var combined_styles = '<style>';

		jQuery( this ).find( 'style' ).each( function() {
			combined_styles += jQuery(this).html();
			jQuery(this).remove();
		});

		combined_styles += '</style>';

		jQuery( this ).prepend( combined_styles );
	});
	});
	</script>
	
	<![endif]-->	
	
	<script type="text/javascript">
	/*@cc_on
		@if (@_jscript_version == 10)
			document.write('<style type="text/css">.search input,#searchform input {padding-left:10px;} .avada-select-parent .select-arrow,.select-arrow{height:33px;<?php if($smof_data['form_bg_color']): ?>background-color:<?php echo $smof_data['form_bg_color']; ?>;<?php endif; ?>}.search input{padding-left:5px;}header .tagline{margin-top:3px;}.star-rating span:before {letter-spacing: 0;}.avada-select-parent .select-arrow,.gravity-select-parent .select-arrow,.wpcf7-select-parent .select-arrow,.select-arrow{background: #fff;}.star-rating{width: 5.2em;}.star-rating span:before {letter-spacing: 0.1em;}</style>');
		@end
	@*/

	var doc = document.documentElement;
	doc.setAttribute('data-useragent', navigator.userAgent);
	</script>

	<?php
	$site_width = (int) $smof_data['site_width'];
	$site_width_percent = false;
	if( strpos( $smof_data['site_width'], '%' ) !== false ) {
		$site_width_percent = true;
	}
	?>
	<style type="text/css">
	<?php	
	$theme_info = wp_get_theme();
	if ($theme_info->parent_theme) {
		$template_dir =  basename(get_template_directory());
		$theme_info = wp_get_theme($template_dir);
	}
	?>
	<?php echo $theme_info->get( 'Name' ) . "_" . $theme_info->get( 'Version' ); ?>{color:green;}
	
	<?php if( ( $isiPad && $smof_data['ipad_potrait'] ) || ! $smof_data['responsive'] ): ?>
	.ua-mobile #wrapper{width: 100% !important; overflow: hidden !important;}
	<?php endif; ?>

	<?php if( $smof_data['layout'] == 'Wide' && $smof_data['content_bg_color'] ): ?>
	html, body { background-color:<?php echo $smof_data['content_bg_color']; ?>; }
	<?php endif; ?>
	
	<?php if( $smof_data['layout'] == 'Boxed' && $smof_data['bg_color'] ): ?>
	html, body { background-color:<?php echo $smof_data['bg_color']; ?>; }
	<?php endif; ?>

	<?php if( ! $site_width_percent ): ?>
	@media only screen and (max-width: <?php echo $site_width; ?>px) {
		.header-social, #header, #small-nav, #footer, .footer-area, #slidingbar, .page-title{ padding-left: 20px !important; padding-right: 20px !important; }		
		#main { padding-left: 20px !important; padding-right: 20px !important; }
		.width-100 .fullwidth-box, .width-100 .fusion-section-separator {
			padding-left: 20px !important;
			padding-right: 20px !important;
		}
		.width-100 .fullwidth-box, .width-100 .fusion-section-separator {
			margin-left: -20px !important;
			margin-right: -20px !important;
		}
		
		.mobile-menu-design-modern #mobile-nav li a { padding-left: 20px; padding-right: 20px; }
		
		.mobile-menu-design-modern #mobile-nav li.mobile-nav-item .open-submenu { padding-right: 25px; }			
		.mobile-menu-design-modern #mobile-nav li.mobile-nav-item li a { padding-left: 32px; }
		.mobile-menu-design-modern #mobile-nav li.mobile-nav-item li li a { padding-left: 45px; }
		.mobile-menu-design-modern #mobile-nav li.mobile-nav-item li li li a { padding-left: 58px; }
		.mobile-menu-design-modern #mobile-nav li.mobile-nav-item li li li li a { padding-left: 71px; }		
	
		.rtl.mobile-menu-design-modern #mobile-nav li.mobile-nav-item .open-submenu { padding-left: 20px; padding-right: 15px; }
		.rtl.mobile-menu-design-modern #mobile-nav li.mobile-nav-item li a { padding-left: 0; padding-right: 32px; }
		.rtl.mobile-menu-design-modern #mobile-nav li.mobile-nav-item li li a { padding-left: 0; padding-right: 45px;	}
		.rtl.mobile-menu-design-modern #mobile-nav li.mobile-nav-item li li li a { padding-left: 0; padding-right: 58px; }
		.rtl.mobile-menu-design-modern #mobile-nav li.mobile-nav-item li li li li a { padding-left: 0; padding-left: 71px; }
	}
	@media only screen and (max-width: 800px) {
		.mobile-menu-design-modern .header-social { padding-left: 0 !important; padding-right: 0 !important; }
	}
	@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation: portrait) {
		.header-social, #header, #small-nav, #footer, .footer-area, .mobile-menu-design-modern .header-social { padding-left: 20px !important; padding-right: 20px !important; }
		#main { padding-left: 20px !important; padding-right: 20px !important; }
		.width-100 .fullwidth-box, .width-100 .fusion-section-separator {
			padding-left: 20px !important;
			padding-right: 20px !important;
		}
		.width-100 .fullwidth-box, .width-100 .fusion-section-separator {
			margin-left: -20px !important;
			margin-right: -20px !important;
		}
	}
	@media only screen and (max-width: 600px) {
		.mobile-menu-design-classic .header-social, #header, #small-nav, #footer, .footer-area, #slidingbar, .page-title { padding-left: 10px !important; padding-right: 10px !important; }
		.mobile-menu-design-modern .header-social { padding-left: 0 !important; padding-right: 0 !important; }
		#main { padding-left: 10px !important; padding-right: 10px !important; }
		.width-100 .fullwidth-box, .width-100 .fusion-section-separator {
			padding-left: 10px !important;
			padding-right: 10px !important;
		}
		.width-100 .fullwidth-box, .width-100 .fusion-section-separator {
			margin-left: -10px !important;
			margin-right: -10px !important;
		}
		
		.mobile-menu-design-modern #mobile-nav li a { padding-left: 10px; padding-right: 10px; }
		
		.mobile-menu-design-modern #mobile-nav li.mobile-nav-item .open-submenu { padding-right: 12px; }			
		.mobile-menu-design-modern #mobile-nav li.mobile-nav-item li a { padding-left: 22px; }
		.mobile-menu-design-modern #mobile-nav li.mobile-nav-item li li a { padding-left: 35px; }
		.mobile-menu-design-modern #mobile-nav li.mobile-nav-item li li li a { padding-left: 48px; }
		.mobile-menu-design-modern #mobile-nav li.mobile-nav-item li li li li a { padding-left: 61px; }		
	
		.rtl.mobile-menu-design-modern #mobile-nav li.mobile-nav-item .open-submenu { padding-left: 10px; padding-right: 15px; }
		.rtl.mobile-menu-design-modern #mobile-nav li.mobile-nav-item li a { padding-left: 0; padding-right: 22px; }
		.rtl.mobile-menu-design-modern #mobile-nav li.mobile-nav-item li li a { padding-left: 0; padding-right: 35px;	}
		.rtl.mobile-menu-design-modern #mobile-nav li.mobile-nav-item li li li a { padding-left: 0; padding-right: 48px; }
		.rtl.mobile-menu-design-modern #mobile-nav li.mobile-nav-item li li li li a { padding-left: 0; padding-left: 61px; }		
	}
	<?php endif; ?>

	<?php
	//IE11
	if (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false):
	?>
	.avada-select-parent .select-arrow,.select-arrow, 
	.wpcf7-select-parent .select-arrow{height:33px;line-height:33px;}
	.gravity-select-parent .select-arrow{height:24px;line-height:24px;}
	
	#wrapper .gf_browser_ie.gform_wrapper .button,
	#wrapper .gf_browser_ie.gform_wrapper .gform_footer input.button{ padding: 0 20px; }
	<?php endif; ?>

	/*IE11 hack */
	@media screen and (-ms-high-contrast: active), (-ms-high-contrast: none) {
		.avada-select-parent .select-arrow,.select-arrow, 
		.wpcf7-select-parent .select-arrow{height:33px;line-height:33px;}
		.gravity-select-parent .select-arrow{height:24px;line-height:24px;}
		
		#wrapper .gf_browser_ie.gform_wrapper .button,
		#wrapper .gf_browser_ie.gform_wrapper .gform_footer input.button{ padding: 0 20px; }
	}

	<?php
	ob_start();
	include_once get_template_directory() . '/framework/dynamic_css.php';
	$dynamic_css = ob_get_contents();
	ob_get_clean();

	if( is_page('header-2') || is_page('header-3') || is_page('header-4') || is_page('header-5') ) {
		$header_demo = true;
	} else {
		$header_demo = false;
	}

	echo $dynamic_css;
	?>
	<?php if($site_width_percent):
	$hundredp_padding = $smof_data['hundredp_padding'];
	$hundredp_padding_int = (int) $hundredp_padding;
	if( get_post_meta( $c_pageID, 'pyre_hundredp_padding', true ) ) {
		$hundredp_padding = get_post_meta( $c_pageID, 'pyre_hundredp_padding', true );
		$hundredp_padding_int = (int) $hundredp_padding;		
	}
	?>
	#header, #main, #footer, .footer-area { padding-left: 0px; padding-right: 0px; }
	.avada-row, .page-title-container { padding-left: <?php echo $hundredp_padding; ?>; padding-right: <?php echo $hundredp_padding; ?>; }
	.fullwidth-box .avada-row { padding-left: <?php echo $hundredp_padding_int; ?>px; padding-right: <?php echo $hundredp_padding_int; ?>px; }
	.fullwidth-box .avada-row .fusion-full-width-sep { margin-left: -<?php echo $hundredp_padding_int; ?>px; margin-right: -<?php echo $hundredp_padding_int; ?>px; }
	.width-100 > .avada-row { padding-left: 0; padding-right: 0; }
	<?php endif; ?>
	<?php if($smof_data['layout'] == 'Boxed'): ?>
	html, body {
		<?php if(get_post_meta($c_pageID, 'pyre_page_bg_color', true)): ?>
		background-color:<?php echo get_post_meta($c_pageID, 'pyre_page_bg_color', true); ?>;
		<?php else: ?>
		background-color:<?php echo $smof_data['bg_color']; ?>;
		<?php endif; ?>
	}
	body{
		<?php if(get_post_meta($c_pageID, 'pyre_page_bg_color', true)): ?>
		background-color:<?php echo get_post_meta($c_pageID, 'pyre_page_bg_color', true); ?>;
		<?php else: ?>
		background-color:<?php echo $smof_data['bg_color']; ?>;
		<?php endif; ?>

		<?php if(get_post_meta($c_pageID, 'pyre_page_bg', true)): ?>
		background-image:url(<?php echo get_post_meta($c_pageID, 'pyre_page_bg', true); ?>);
		background-repeat:<?php echo get_post_meta($c_pageID, 'pyre_page_bg_repeat', true); ?>;
			<?php if(get_post_meta($c_pageID, 'pyre_page_bg_full', true) == 'yes'): ?>
			background-attachment:fixed;
			background-position:center center;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
			<?php endif; ?>
		<?php elseif($smof_data['bg_image']): ?>
		background-image:url(<?php echo $smof_data['bg_image']; ?>);
		background-repeat:<?php echo $smof_data['bg_repeat']; ?>;
			<?php if($smof_data['bg_full']): ?>
			background-attachment:fixed;
			background-position:center center;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
			<?php endif; ?>
		<?php endif; ?>
	}
	<?php if($smof_data['bg_pattern_option'] && $smof_data['bg_pattern'] && !(get_post_meta($c_pageID, 'pyre_page_bg_color', true) || get_post_meta($c_pageID, 'pyre_page_bg', true))): ?>
	html, body {
		background-image:url("<?php echo get_template_directory_uri() . '/images/patterns/' . $smof_data['bg_pattern'] . '.png'; ?>");
		background-repeat:repeat;
	}
	<?php endif; ?>		
	#wrapper{
		max-width:<?php if( $site_width_percent ) { echo $smof_data['site_width']; } else { echo ( $site_width + 60 ) .  'px'; } ?>;
		margin:0 auto;
	}
	.wrapper_blank { display: block; }
	
	@media (min-width: 1014px) {
		body #header-sticky.sticky-header {
			width:<?php if( $site_width_percent ) { echo $smof_data['site_width']; } else { echo ( $site_width + 60 ) .  'px'; } ?>;
			left: 0;
			right: 0;
			margin:0 auto;
		}	
	}
	
	<?php if($smof_data['responsive'] && $site_width_percent ): ?>
	#header-sticky .avada-row,#header .avada-row, #main .avada-row, .footer-area .avada-row,#slidingbar-area .avada-row, #footer .avada-row, .page-title, .header-social .avada-row, #small-nav .avada-row{ max-width: none; padding: 0 10px; }
	<?php endif; ?>
	
	<?php if( $smof_data['responsive'] ): ?>
	@media only screen and (min-width: 801px) and (max-width: 1014px){
		#wrapper{
			width:auto;
		}
	}
	@media only screen and (min-device-width: 801px) and (max-device-width: 1014px){
		#wrapper{
			width:auto;
		}
	}
	<?php endif; ?>
	<?php endif; ?>

	<?php if($smof_data['layout'] == 'Wide'): ?>
	#wrapper{
		width:100%;
		max-width: none;
	}
	//.wrapper_blank { display: block; }
	@media only screen and (min-width: 801px) and (max-width: 1014px){
		#wrapper{
			width:auto;
		}
	}
	@media only screen and (min-device-width: 801px) and (max-device-width: 1014px){
		#wrapper{
			width:auto;
		}
	}
	<?php endif; ?>

	<?php if(get_post_meta($c_pageID, 'pyre_page_bg_layout', true) == 'boxed'): ?>
	html, body {
		<?php if(get_post_meta($c_pageID, 'pyre_page_bg_color', true)): ?>
		background-color:<?php echo get_post_meta($c_pageID, 'pyre_page_bg_color', true); ?>;
		<?php else: ?>
		background-color:<?php echo $smof_data['bg_color']; ?>;
		<?php endif; ?>
	}
	body{
		<?php if(get_post_meta($c_pageID, 'pyre_page_bg_color', true)): ?>
		background-color:<?php echo get_post_meta($c_pageID, 'pyre_page_bg_color', true); ?>;
		<?php else: ?>
		background-color:<?php echo $smof_data['bg_color']; ?>;
		<?php endif; ?>

		<?php if(get_post_meta($c_pageID, 'pyre_page_bg', true)): ?>
		background-image:url(<?php echo get_post_meta($c_pageID, 'pyre_page_bg', true); ?>);
		background-repeat:<?php echo get_post_meta($c_pageID, 'pyre_page_bg_repeat', true); ?>;
			<?php if(get_post_meta($c_pageID, 'pyre_page_bg_full', true) == 'yes'): ?>
			background-attachment:fixed;
			background-position:center center;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
			<?php endif; ?>
		<?php elseif($smof_data['bg_image']): ?>
		background-image:url(<?php echo $smof_data['bg_image']; ?>);
		background-repeat:<?php echo $smof_data['bg_repeat']; ?>;
			<?php if($smof_data['bg_full']): ?>
			background-attachment:fixed;
			background-position:center center;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
			<?php endif; ?>
		<?php endif; ?>

		<?php if($smof_data['bg_pattern_option'] && $smof_data['bg_pattern'] && !(get_post_meta($c_pageID, 'pyre_page_bg_color', true) || get_post_meta($c_pageID, 'pyre_page_bg', true))): ?>
		background-image:url("<?php echo get_template_directory_uri() . '/images/patterns/' . $smof_data['bg_pattern'] . '.png'; ?>");
		background-repeat:repeat;
		<?php endif; ?>
	}
	
	#wrapper{
		width:<?php if( $site_width_percent ) { echo $smof_data['site_width']; } else { echo ( $site_width + 60 ) .  'px'; } ?>;
		margin:0 auto;
	}
	.wrapper_blank { display: block; }
	@media (min-width: 1014px) {
		body #header-sticky.sticky-header {
			width:<?php if( $site_width_percent ) { echo $smof_data['site_width']; } else { echo ( $site_width + 60 ) .  'px'; } ?>;
			left: 0;
			right: 0;
			margin:0 auto;
		}	
	}
	@media only screen and (min-width: 801px) and (max-width: 1014px){
		#wrapper{
			width:auto;
		}
	}
	@media only screen and (min-device-width: 801px) and (max-device-width: 1014px){
		#wrapper{
			width:auto;
		}
	}
	<?php endif; ?>

	<?php if(get_post_meta($c_pageID, 'pyre_page_bg_layout', true) == 'wide'): ?>
	#wrapper{
		width:100%;
		max-width: none;
	}
	//.wrapper_blank { display: block; }
	@media only screen and (min-width: 801px) and (max-width: 1014px){
		#wrapper{
			width:auto;
		}
	}
	@media only screen and (min-device-width: 801px) and (max-device-width: 1014px){
		#wrapper{
			width:auto;
		}
	}
	body #header-sticky.sticky-header {
		width: 100%;
		left: 0;
		right: 0;
		margin:0 auto;
	}
	<?php endif; ?>
	
	<?php if(get_post_meta($c_pageID, 'pyre_page_bg', true) || $smof_data['bg_image'] ): ?>
	html { background: none; }
	<?php endif; ?>		

	<?php if( $smof_data['mobile_nav_padding'] ): ?>
	@media only screen and (min-device-width: 768px) and (max-device-width: 1366px) and (orientation: portrait){
		#nav > ul > li, #sticky-nav > ul > li { padding-right: <?php echo $smof_data['mobile_nav_padding']; ?>px; }
	}
	@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation: landscape){
		#nav > ul > li, #sticky-nav > ul > li { padding-right: <?php echo $smof_data['mobile_nav_padding']; ?>px; }
	}
	<?php endif; ?>

	<?php if(get_post_meta($c_pageID, 'pyre_page_title_bar_bg', true)): ?>
	.page-title-container{
		background-image:url(<?php echo get_post_meta($c_pageID, 'pyre_page_title_bar_bg', true); ?>);
	}
	<?php elseif($smof_data['page_title_bg']): ?>
	.page-title-container{
		background-image:url(<?php echo $smof_data['page_title_bg']; ?>);
	}
	<?php endif; ?>

	<?php if(get_post_meta($c_pageID, 'pyre_page_title_bar_bg_color', true)): ?>
	.page-title-container{
		background-color:<?php echo get_post_meta($c_pageID, 'pyre_page_title_bar_bg_color', true); ?>;
	}
	<?php elseif($smof_data['page_title_bg_color']): ?>
	.page-title-container{
		background-color:<?php echo $smof_data['page_title_bg_color']; ?>;
	}
	<?php endif; ?>

	#header{
		<?php if($smof_data['header_bg_image']): ?>
		background-image:url(<?php echo $smof_data['header_bg_image']; ?>);
		<?php if($smof_data['header_bg_repeat'] == 'repeat-y' || $smof_data['header_bg_repeat'] == 'no-repeat'): ?>
		background-position: center center;
		<?php endif; ?>
		background-repeat:<?php echo $smof_data['header_bg_repeat']; ?>;
			<?php if($smof_data['header_bg_full']): ?>
			background-attachment:scroll;
			background-position:center center;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
			<?php endif; ?>

		<?php if($smof_data['header_bg_parallax']) : ?>
		background-attachment: fixed;
		background-position:top center;
		<?php endif; ?>
		<?php endif; ?>
	}

	#header{
		<?php if(get_post_meta($c_pageID, 'pyre_header_bg_color', true)): ?>
		background-color:<?php echo get_post_meta($c_pageID, 'pyre_header_bg_color', true); ?>;
		<?php endif; ?>
		<?php if(get_post_meta($c_pageID, 'pyre_header_bg', true)): ?>
		background-image:url(<?php echo get_post_meta($c_pageID, 'pyre_header_bg', true); ?>);
		<?php if(get_post_meta($c_pageID, 'pyre_header_bg_repeat', true) == 'repeat-y' || get_post_meta($c_pageID, 'pyre_header_bg_repeat', true) == 'no-repeat'): ?>
		background-position: center center;
		<?php endif; ?>
		background-repeat:<?php echo get_post_meta($c_pageID, 'pyre_header_bg_repeat', true); ?>;
			<?php if(get_post_meta($c_pageID, 'pyre_header_bg_full', true) == 'yes'): ?>
			background-attachment:fixed;
			background-position:center center;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
			<?php endif; ?>
		<?php if($smof_data['header_bg_parallax']) : ?>
		background-attachment: fixed;
		background-position:top center;
		<?php endif; ?>
		<?php endif; ?>
	}

	<?php $main_bg_image = false; ?>

	#main{
		<?php if($smof_data['content_bg_image'] && !get_post_meta($c_pageID, 'pyre_wide_page_bg_color', true)): $main_bg_image = true; ?>
		background-image:url(<?php echo $smof_data['content_bg_image']; ?>);
		background-repeat:<?php echo $smof_data['content_bg_repeat']; ?>;
			<?php if($smof_data['content_bg_full']): ?>
			background-attachment:fixed;
			background-position:center center;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
			<?php endif; ?>
		<?php endif; ?>

		<?php if($smof_data['main_top_padding'] && !get_post_meta($c_pageID, 'pyre_main_top_padding', true)): ?>
		padding-top: <?php echo $smof_data['main_top_padding']; ?>;
		<?php endif; ?>

		<?php if($smof_data['main_bottom_padding'] && !get_post_meta($c_pageID, 'pyre_main_bottom_padding', true)): ?>
		padding-bottom: <?php echo $smof_data['main_bottom_padding']; ?>;
		<?php endif; ?>
	}

	<?php if(get_post_meta($c_pageID, 'pyre_page_bg_layout', true) == 'wide' && get_post_meta($c_pageID, 'pyre_wide_page_bg_color', true)): ?>
	html, body, #wrapper {
		background-color:<?php echo get_post_meta($c_pageID, 'pyre_wide_page_bg_color', true); ?>;
	}
	<?php endif; ?>

	#main{
		<?php if(get_post_meta($c_pageID, 'pyre_wide_page_bg_color', true)): ?>
		background-color:<?php echo get_post_meta($c_pageID, 'pyre_wide_page_bg_color', true); ?>;
		<?php endif; ?>
		<?php if(get_post_meta($c_pageID, 'pyre_wide_page_bg', true)): $main_bg_image = true; ?>
		background-image:url(<?php echo get_post_meta($c_pageID, 'pyre_wide_page_bg', true); ?>);
		background-repeat:<?php echo get_post_meta($c_pageID, 'pyre_wide_page_bg_repeat', true); ?>;
			<?php if(get_post_meta($c_pageID, 'pyre_wide_page_bg_full', true) == 'yes'): ?>
			background-attachment:fixed;
			background-position:center center;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
			<?php endif; ?>
		<?php endif; ?>

		<?php if(get_post_meta($c_pageID, 'pyre_main_top_padding', true)): ?>
		padding-top:<?php echo get_post_meta($c_pageID, 'pyre_main_top_padding', true); ?>;
		<?php endif; ?>

		<?php if(get_post_meta($c_pageID, 'pyre_main_bottom_padding', true)): ?>
		padding-bottom:<?php echo get_post_meta($c_pageID, 'pyre_main_bottom_padding', true); ?>;
		<?php endif; ?>

	}

	<?php if($main_bg_image): ?>
	#main .sidebar { background-color: transparent !important; }
	<?php endif; ?>

	.page-title-container{
		<?php if($smof_data['page_title_bg_full']): ?>
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		<?php endif; ?>

		<?php if(get_post_meta($c_pageID, 'pyre_page_title_bar_bg_full', true) == 'yes'): ?>
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		<?php elseif(get_post_meta($c_pageID, 'pyre_page_title_bar_bg_full', true) == 'no'): ?>
		-webkit-background-size: auto;
		-moz-background-size: auto;
		-o-background-size: auto;
		background-size: auto;
		<?php endif; ?>

		<?php if($smof_data['page_title_bg_parallax']): ?>
		background-attachment: fixed;
		background-position:top center;
		<?php endif; ?>

		<?php if(get_post_meta($c_pageID, 'pyre_page_title_bg_parallax', true) == 'yes'): ?>
		background-attachment: fixed;
		background-position:top center;
		<?php elseif(get_post_meta($c_pageID, 'pyre_page_title_bg_parallax', true) == 'no'): ?>
		background-attachment: scroll;
		<?php endif; ?>

	}

	<?php if(get_post_meta($c_pageID, 'pyre_page_title_height', true)): ?>
	.page-title-container{
		height:<?php echo get_post_meta($c_pageID, 'pyre_page_title_height', true); ?>;
	}
	<?php elseif($smof_data['page_title_height']): ?>
	.page-title-container{
		height:<?php echo $smof_data['page_title_height']; ?>;
	}
	<?php endif; ?>

	<?php if(is_single() && get_post_meta($c_pageID, 'pyre_fimg_width', true)): ?>
	<?php if(get_post_meta($c_pageID, 'pyre_fimg_width', true) != 'auto'): ?>
	#post-<?php echo $c_pageID; ?> .post-slideshow {max-width:<?php echo get_post_meta($c_pageID, 'pyre_fimg_width', true); ?>;}
	<?php else: ?>
	.post-slideshow .flex-control-nav{position:relative;text-align:left;margin-top:10px;}
	<?php endif; ?>
	#post-<?php echo $c_pageID; ?> .post-slideshow img{max-width:<?php echo get_post_meta($c_pageID, 'pyre_fimg_width', true); ?>;}
		<?php if(get_post_meta($c_pageID, 'pyre_fimg_width', true) == 'auto'): ?>
		#post-<?php echo $c_pageID; ?> .post-slideshow img{width:<?php echo get_post_meta($c_pageID, 'pyre_fimg_width', true); ?>;}
		<?php endif; ?>
	<?php endif; ?>

	<?php if(is_single() && get_post_meta($c_pageID, 'pyre_fimg_height', true)): ?>
	#post-<?php echo $c_pageID; ?> .post-slideshow, #post-<?php echo $c_pageID; ?> .post-slideshow img{max-height:<?php echo get_post_meta($c_pageID, 'pyre_fimg_height', true); ?>;}
	#post-<?php echo $c_pageID; ?> .post-slideshow .slides { max-height: 100%; }
	<?php endif; ?>

	<?php if(get_post_meta($c_pageID, 'pyre_page_title_bar_bg_retina', true)): ?>
	@media only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min-device-pixel-ratio: 2) {
		.page-title-container {
			background-image: url(<?php echo get_post_meta($c_pageID, 'pyre_page_title_bar_bg_retina', true); ?>);
			-webkit-background-size:cover;
			   -moz-background-size:cover;
				 -o-background-size:cover;
					background-size:cover;
		}
	}
	<?php elseif($smof_data['page_title_bg_retina']): ?>
	@media only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min-device-pixel-ratio: 2) {
		.page-title-container {
			background-image: url(<?php echo $smof_data['page_title_bg_retina']; ?>);
			-webkit-background-size:cover;
			   -moz-background-size:cover;
				 -o-background-size:cover;
					background-size:cover;
		}
	}
	<?php endif; ?>

	<?php if(get_post_meta($c_pageID, 'pyre_hundredp_padding', true)): ?>
	.width-100 .fullwidth-box, .width-100 .fusion-section-separator {
		margin-left: -<?php echo get_post_meta($c_pageID, 'pyre_hundredp_padding', true); ?>; margin-right: -<?php echo get_post_meta($c_pageID, 'pyre_hundredp_padding', true); ?>;
	}
	<?php elseif($smof_data['hundredp_padding']): ?>
	.width-100 .fullwidth-box, .width-100 .fusion-section-separator {
		margin-left: -<?php echo $smof_data['hundredp_padding'] ?>; margin-right: -<?php echo $smof_data['hundredp_padding'] ?>;
	}
	<?php endif; ?>

	<?php if((float) $wp_version < 3.8): ?>
	#wpadminbar *{color:#ccc;}
	#wpadminbar .hover a, #wpadminbar .hover a span{color:#464646;}
	<?php endif; ?>
	<?php echo $smof_data['custom_css']; ?>

	<?php if( ( ($smof_data['header_transparent'] && get_post_meta($object_id, 'pyre_transparent_header', true) != 'no' ) || ( ! $smof_data['header_transparent'] && get_post_meta($object_id, 'pyre_transparent_header', true) == 'yes' ) ) 
			  && ! is_search() 
			  && ! is_404()
			  && ! is_author()
			  && ! is_archive()
	): ?>
		@media only screen and (min-width: 800px){
			#header,#small-nav,.header-v4 #small-nav, .header-v5 #small-nav{background:none;}
			.header-social, #header, .header-v4 #small-nav, .header-v5 #small-nav,.header-v5 #header{border:none;}
			.header-wrapper,.header-filler{position: absolute;left:0;right:0;z-index: 10000;}
			.header-filler{z-index: 1;}
			
			.nav-holder#nav .navigation > li > a{background:rgba(255,255,255,0);}
		}
	<?php endif; ?>

	.woocommerce-invalid:after { content: '<?php echo __('Please enter correct details for this required field.', 'Avada'); ?>'; display: inline-block; margin-top: 7px; color: red; }

	<?php if(get_post_meta($c_pageID, 'pyre_fallback', true)): ?>
	@media only screen and (max-width: 940px){
		#sliders-container{display:none;}
		#fallback-slide{display:block;}
	}
	@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation: portrait){
		#sliders-container{display:none;}
		#fallback-slide{display:block;}
	}
	<?php endif; ?>

	<?php if(is_page_template('contact.php') && $smof_data['gmap_address'] && !$smof_data['status_gmap']): ?>
	.avada-google-map{
		width:<?php echo $smof_data['gmap_width']; ?>;
		margin:0 auto;
		<?php if($smof_data['gmap_width'] != '100%'): ?>
		<?php if($smof_data['gmap_topmargin']): ?>
		margin-top:<?php echo $smof_data['gmap_topmargin']; ?>;
		<?php else: ?>
		margin-top:55px;
		<?php endif; ?>
		<?php endif; ?>

		<?php if($smof_data['gmap_height']): ?>
		height:<?php echo $smof_data['gmap_height']; ?>;
		<?php else: ?>
		height:415px;
		<?php endif; ?>
	}
	<?php endif; ?>

	<?php if(is_page_template('contact-2.php') && $smof_data['gmap_address'] && !$smof_data['status_gmap']): ?>
	.avada-google-map{
		margin:0 auto;
		margin-top:55px;
		height:415px !important;
		width:940px !important;		
	}
	<?php endif; ?>
	</style>

	<?php if($smof_data['google_body'] && $smof_data['google_body'] != 'Select Font'): ?>
	<?php $gfont[urlencode($smof_data['google_body'])] = '' . urlencode($smof_data['google_body']); ?>
	<?php endif; ?>

	<?php if($smof_data['google_nav'] && $smof_data['google_nav'] != 'Select Font' && $smof_data['google_nav'] != $smof_data['google_body']): ?>
	<?php $gfont[urlencode($smof_data['google_nav'])] = '' . urlencode($smof_data['google_nav']); ?>
	<?php endif; ?>

	<?php if($smof_data['google_headings'] && $smof_data['google_headings'] != 'Select Font' && $smof_data['google_headings'] != $smof_data['google_body'] && $smof_data['google_headings'] != $smof_data['google_nav']): ?>
	<?php $gfont[urlencode($smof_data['google_headings'])] = '' . urlencode($smof_data['google_headings']); ?>
	<?php endif; ?>

	<?php if($smof_data['google_footer_headings'] && $smof_data['google_footer_headings'] != 'Select Font' && $smof_data['google_footer_headings'] != $smof_data['google_body'] && $smof_data['google_footer_headings'] != $smof_data['google_nav'] && $smof_data['google_footer_headings'] != $smof_data['google_headings']): ?>
	<?php $gfont[urlencode($smof_data['google_footer_headings'])] = '' . urlencode($smof_data['google_footer_headings']); ?>
	<?php endif; ?>

	<?php if(isset( $gfont ) && $gfont): ?>
	<?php
	foreach( $gfont as $g_font ) {
		echo "<link href='http" . ((is_ssl()) ? 's' : '') . "://fonts.googleapis.com/css?family={$g_font}:" . $smof_data['gfont_settings'] . "' rel='stylesheet' type='text/css' />";
	}
	?>
	<?php endif; ?>
	
	<?php echo $smof_data['google_analytics']; ?>

	<?php echo $smof_data['space_head']; ?>
</head>
<?php
$body_classes = array();
$wrapper_class = '';
if( is_page_template('blank.php') ) {
	$body_classes[] = 'body_blank';
	$wrapper_class = 'wrapper_blank';
}
if( ! $smof_data['header_sticky_tablet'] ) {
	$body_classes[] = 'no-tablet-sticky-header';
}
if( ! $smof_data['header_sticky_mobile'] ) {
	$body_classes[] = 'no-mobile-sticky-header';
}
if( $smof_data['mobile_slidingbar_widgets'] ) {
	$body_classes[] = 'no-mobile-slidingbar';
}
if( $smof_data['status_totop'] ) {
	$body_classes[] = 'no-totop';
}
if( ! $smof_data['status_totop_mobile'] ) {
	$body_classes[] = 'no-mobile-totop';
}
if( $smof_data['mobile_menu_design'] == 'modern' ) {
	$mobile_logo_pos = strtolower( $smof_data['logo_alignment'] );
	if( strtolower( $smof_data['logo_alignment'] ) == 'center' ) {
		$mobile_logo_pos = 'left';
	}
	$body_classes[] = 'mobile-logo-pos-' . $mobile_logo_pos;
}
if( $smof_data['layout'] == 'Boxed' || get_post_meta($c_pageID, 'pyre_page_bg_layout', true) == 'boxed' ) {
	$body_classes[] = 'layout-boxed-mode';
}
$sidebar_1 = get_post_meta( $c_pageID, 'sbg_selected_sidebar_replacement', true );
$sidebar_2 = get_post_meta( $c_pageID, 'sbg_selected_sidebar_2_replacement', true );
if( is_single() && ! is_singular( 'avada_portfolio' ) && ! is_singular( 'product' ) && ! is_bbpress() ) {
	if( $smof_data['posts_global_sidebar'] ) {
		if( $smof_data['posts_sidebar'] != 'None' ) {
			$sidebar_1 = array( $smof_data['posts_sidebar'] );
		} else {
			$sidebar_1 = '';
		}

		if( $smof_data['posts_sidebar_2'] != 'None' ) {
			$sidebar_2 = array( $smof_data['posts_sidebar_2'] );
		} else {
			$sidebar_2 = '';
		}
	}
} else if( is_singular( 'avada_portfolio' ) ) {
	if( $smof_data['portfolio_global_sidebar'] ) {
		if( $smof_data['portfolio_sidebar'] != 'None' ) {
			$sidebar_1 = array( $smof_data['portfolio_sidebar'] );
		} else {
			$sidebar_1 = '';
		}

		if( $smof_data['portfolio_sidebar_2'] != 'None' ) {
			$sidebar_2 = array( $smof_data['portfolio_sidebar_2'] );
		} else {
			$sidebar_2 = '';
		}
	}
} else if( is_singular( 'product' ) ) {
	if( $smof_data['woo_global_sidebar'] ) {
		if( $smof_data['woo_sidebar'] != 'None' ) {
			$sidebar_1 = array( $smof_data['woo_sidebar'] );
		} else {
			$sidebar_1 = '';
		}

		if( $smof_data['woo_sidebar_2'] != 'None' ) {
			$sidebar_2 = array( $smof_data['woo_sidebar_2'] );
		} else {
			$sidebar_2 = '';
		}
	}
} else if( ( is_page() || is_page_template() ) && ( ! is_page_template('100-width.php') && ! is_page_template('blank.php') ) ) {
	if( $smof_data['pages_global_sidebar'] ) {
		if( $smof_data['pages_sidebar'] != 'None' ) {
			$sidebar_1 = array( $smof_data['pages_sidebar'] );
		} else {
			$sidebar_1 = '';
		}

		if( $smof_data['pages_sidebar_2'] != 'None' ) {
			$sidebar_2 = array( $smof_data['pages_sidebar_2'] );
		} else {
			$sidebar_2 = '';
		}
	}
}
if( is_array( $sidebar_1 ) && $sidebar_1[0] && is_array( $sidebar_2 ) && $sidebar_2[0] && ! is_bbpress() ) {
	$body_classes[] = 'double-sidebars';
}

if( is_page_template( 'side-navigation.php' ) && is_array( $sidebar_2 ) && $sidebar_2[0] ) {
	$body_classes[] = 'double-sidebars';
}
if( is_home() ) {
	$sidebar_1 = $smof_data['blog_archive_sidebar'];
	$sidebar_2 = $smof_data['blog_archive_sidebar_2'];
	if( $sidebar_1 != 'None' && $sidebar_2 != 'None' ) {
		$body_classes[] = 'double-sidebars';
	}
}

if( is_archive() && ( ( class_exists('Woocommerce') && ! is_shop() ) || ! class_exists('Woocommerce') ) && ! is_tax( 'portfolio_category' ) && ! is_tax( 'portfolio_skills' )  && ! is_tax( 'portfolio_tags' ) && ! is_tax( 'product_cat') && ! is_tax( 'product_tag' ) ) {
	$sidebar_1 = $smof_data['blog_archive_sidebar'];
	$sidebar_2 = $smof_data['blog_archive_sidebar_2'];

	if( $sidebar_1 != 'None' && $sidebar_2 != 'None' ) {
		$body_classes[] = 'double-sidebars';
	}
}

if( is_tax( 'portfolio_category' ) || is_tax( 'portfolio_skills' )  || is_tax( 'portfolio_tags' ) ) {
	$sidebar_1 = $smof_data['portfolio_archive_sidebar'];
	$sidebar_2 = $smof_data['portfolio_archive_sidebar_2'];
	if( $sidebar_1 != 'None' && $sidebar_2 != 'None' ) {
		$body_classes[] = 'double-sidebars';
	}
}
if( is_tax( 'product_cat' )  || is_tax( 'product_tag' ) ) {
	$sidebar_1 = $smof_data['woocommerce_archive_sidebar'];
	$sidebar_2 = $smof_data['woocommerce_archive_sidebar_2'];
	if( $sidebar_1 != 'None' && $sidebar_2 != 'None' ) {
		$body_classes[] = 'double-sidebars';
	}
}
if( is_search() ) {
	$sidebar_1 = $smof_data['search_sidebar'];
	$sidebar_2 = $smof_data['search_sidebar_2'];
	if( $sidebar_1 != 'None' && $sidebar_2 != 'None' ) {
		$body_classes[] = 'double-sidebars';
	}
}
if( is_bbpress() ) {
	$sidebar_1 = $smof_data['ppbress_sidebar'];
	$sidebar_2 = $smof_data['ppbress_sidebar_2'];

	$page_option_sidebar_1 = get_post_meta( $c_pageID, 'sbg_selected_sidebar_replacement', true );
	$page_option_sidebar_2 = get_post_meta( $c_pageID, 'sbg_selected_sidebar_2_replacement', true );

	if( $smof_data['bbpress_global_sidebar'] ) {
		if( $sidebar_1 == 'None' && is_array( $page_option_sidebar_1 ) && $page_option_sidebar_1[0] == 'Blog Sidebar' ) {
			$page_option_sidebar_1 = false;
		}

		if( $sidebar_2 == 'None' && is_array( $page_option_sidebar_2 ) && $page_option_sidebar_2[0] == 'Blog Sidebar' ) {
			$page_option_sidebar_2 = false;
		}
	}

	if( is_array( $page_option_sidebar_1 ) && $page_option_sidebar_1[0] && 
		is_array( $page_option_sidebar_2 ) && $page_option_sidebar_2[0] 
	) {
		$body_classes[] = 'double-sidebars';
	} else if( is_array( $page_option_sidebar_1 ) && $page_option_sidebar_1[0] &&
				$page_option_sidebar_2 == '' &&
				$sidebar_2 != 'None' 
	) {
		$body_classes[] = 'double-sidebars';
	} else if( $page_option_sidebar_1 == '' &&
				$page_option_sidebar_2 == '' &&
				$sidebar_1 != 'None' && 
				$sidebar_2 != 'None'
	) {
		$body_classes[] = 'double-sidebars';
	}
}

if( is_bbpress() && bbp_is_forum_archive() ) {
	$sidebar_1 = $smof_data['ppbress_sidebar'];
	$sidebar_2 = $smof_data['ppbress_sidebar_2'];
	
	if( $sidebar_1 != 'None' && $sidebar_2 != 'None' ) {
		$body_classes[] = 'double-sidebars';
	}
}
$body_classes[] = 'mobile-menu-design-' . $smof_data['mobile_menu_design'];
?>
<body <?php body_class( $body_classes ); ?> data-spy="scroll">
	<div id="wrapper" class="<?php echo $wrapper_class; ?>">
	<?php if( $smof_data['slidingbar_widgets'] && ! is_page_template( 'blank.php' ) ): ?>
	<?php get_template_part( 'slidingbar' ); ?>
	<?php endif; ?>
	<?php
	get_template_part( 'framework/templates/header' );
	avada_header_template( 'Below' );
	?>
	<div id="sliders-container">
	<?php
	if( is_search() ) {
		$slider_page_id = '';
	}
	if( ! is_search() ) {
		// Layer Slider
		$slider_page_id = '';
		if ( ! is_home() && ! is_front_page() && ! is_archive() && isset( $object_id ) ) {
			$slider_page_id = $object_id;
		}
		if ( ! is_home() && is_front_page() && isset( $object_id ) ) {
			$slider_page_id = $object_id;
		}
		if ( is_home() && ! is_front_page() ) {
			$slider_page_id = get_option( 'page_for_posts' );
		}
		if ( class_exists( 'Woocommerce' ) ) {
			if ( is_shop() ) {
				$slider_page_id = get_option( 'woocommerce_shop_page_id' );
			}
		}
		avada_slider( $slider_page_id );
	}
	?>
	</div>
	<?php if(get_post_meta($slider_page_id, 'pyre_fallback', true)): ?>
		<div id="fallback-slide">
			<img src="<?php echo get_post_meta($slider_page_id, 'pyre_fallback', true); ?>" alt="" />
		</div>
	<?php endif; ?>
	<?php
	avada_header_template( 'Above' );
	avada_current_page_title_bar( $c_pageID );
	?>
	<?php if(is_page_template('contact.php') && $smof_data['recaptcha_public'] && $smof_data['recaptcha_private']): ?>
	<script type="text/javascript">
	 var RecaptchaOptions = {
		theme : '<?php echo $smof_data['recaptcha_color_scheme']; ?>'
	 };
 	</script>
 	<?php endif; ?>
	<?php if(is_page_template('contact.php') && $smof_data['gmap_address'] && !$smof_data['status_gmap']): ?>
	<?php
	if( ! $smof_data['map_popup'] ) {
		$map_popup = 'yes';
	} else {
		$map_popup = 'no';
	}
	if( ! $smof_data['map_scrollwheel'] ) {
		$map_scrollwheel = 'yes';
	} else {
		$map_scrollwheel = 'no';
	}
	if( ! $smof_data['map_scale'] ) {
		$map_scale = 'yes';
	} else {
		$map_scale = 'no';
	}
	if( ! $smof_data['map_zoomcontrol'] ) {
		$map_zoomcontrol = 'yes';
	} else {
		$map_zoomcontrol = 'no';
	}
	if( ! $smof_data['map_pin'] ) {
		$address_pin = 'yes';
	} else {
		$address_pin = 'no';
	}
	echo do_shortcode('[avada_map address="' . $smof_data['gmap_address'] . '" type="' . $smof_data['gmap_type'] . '" address_pin="' . $address_pin . '" map_style="' . $smof_data['map_styling'] . '" overlay_color="' . $smof_data['map_overlay_color'] . '" infobox="' . $smof_data['map_infobox_styling'] . '" infobox_background_color="' . $smof_data['map_infobox_bg_color'] . '" infobox_text_color="' . $smof_data['map_infobox_text_color'] . '" infobox_content="' . $smof_data['map_infobox_content'] . '" icon="' . $smof_data['map_custom_marker_icon'] . '" width="' . $smof_data['gmap_width'] . '" height="' . $smof_data['gmap_height'] . '" zoom="' . $smof_data['map_zoom_level'] . '" scrollwheel="' . $map_scrollwheel . '" scale="' . $map_scale . '" zoom_pancontrol="' . $map_zoomcontrol . '" popup="' . $map_popup . '"][/avada_map]');
	?>
	<?php endif; ?>
	<?php if(is_page_template('contact-2.php') && $smof_data['gmap_address'] && !$smof_data['status_gmap']): ?>
	<?php
	if( $smof_data['map_popup'] ) {
		$map_popup = 'yes';
	} else {
		$map_popup = 'no';
	}
	if( ! $smof_data['map_scrollwheel'] ) {
		$map_scrollwheel = 'yes';
	} else {
		$map_scrollwheel = 'no';
	}
	if( ! $smof_data['map_scale'] ) {
		$map_scale = 'yes';
	} else {
		$map_scale = 'no';
	}
	if( ! $smof_data['map_zoomcontrol'] ) {
		$map_zoomcontrol = 'yes';
	} else {
		$map_zoomcontrol = 'no';
	}
	echo do_shortcode('[avada_map address="' . $smof_data['gmap_address'] . '" type="' . $smof_data['gmap_type'] . '" map_style="' . $smof_data['map_styling'] . '" overlay_color="' . $smof_data['map_overlay_color'] . '" infobox="' . $smof_data['map_infobox_styling'] . '" infobox_background_color="' . $smof_data['map_infobox_bg_color'] . '" infobox_text_color="' . $smof_data['map_infobox_text_color'] . '" infobox_content="' . $smof_data['map_infobox_content'] . '" icon="' . $smof_data['map_custom_marker_icon'] . '" width="' . $smof_data['gmap_width'] . '" height="' . $smof_data['gmap_height'] . '" zoom="' . $smof_data['map_zoom_level'] . '" scrollwheel="' . $map_scrollwheel . '" scale="' . $map_scale . '" zoom_pancontrol="' . $map_zoomcontrol . '" popup="' . $map_popup . '"][/avada_map]');
	?>
	<?php endif; ?>
	<?php
	$main_css = '';
	$row_css = '';
	$main_class = '';
	$page_template = '';

	if (is_woocommerce()) {
		$custom_fields = get_post_custom_values('_wp_page_template', $c_pageID);
		if(is_array($custom_fields) && !empty($custom_fields)) {
			$page_template = $custom_fields[0];
		} else {
			$page_template = '';
		}
	}

	if(is_page_template('100-width.php') || is_page_template('blank.php') ||get_post_meta($slider_page_id, 'pyre_portfolio_width_100', true) == 'yes' || $page_template == '100-width.php') {
		$main_css = 'padding-left:0px;padding-right:0px;';
		if($smof_data['hundredp_padding'] && !get_post_meta($c_pageID, 'pyre_hundredp_padding', true)) {
			$main_css = 'padding-left:'.$smof_data['hundredp_padding'].';padding-right:'.$smof_data['hundredp_padding'];
		}
		if(get_post_meta($c_pageID, 'pyre_hundredp_padding', true)) {
			$main_css = 'padding-left:'.get_post_meta($c_pageID, 'pyre_hundredp_padding', true).';padding-right:'.get_post_meta($c_pageID, 'pyre_hundredp_padding', true);
		}
		$row_css = 'max-width:100%;';
		$main_class = 'width-100';
	}
	?>
	<div id="main" class="clearfix <?php echo $main_class; ?>" style="<?php echo $main_css; ?>">
		<div class="avada-row" style="<?php echo $row_css; ?>">