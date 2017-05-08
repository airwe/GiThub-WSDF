<?php
// Template Name: Portfolio Three Column Text
get_header(); ?>
	<?php
	$content_css = 'width:100%';
	$sidebar_css = 'display:none';
	$content_class = '';
	$sidebar_exists = false;
	$sidebar_left = '';
	$double_sidebars = false;

	$sidebar_1 = get_post_meta( $post->ID, 'sbg_selected_sidebar_replacement', true );
	$sidebar_2 = get_post_meta( $post->ID, 'sbg_selected_sidebar_2_replacement', true );

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

	if( ( is_array( $sidebar_1 ) && ( $sidebar_1[0] || $sidebar_1[0] === '0' ) ) && ( is_array( $sidebar_2 ) && ( $sidebar_2[0] || $sidebar_2[0] === '0' ) ) ) {
		$double_sidebars = true;
	}

	if( is_array( $sidebar_1 ) &&
		( $sidebar_1[0] || $sidebar_1[0] === '0' ) 
	) {
		$sidebar_exists = true;
	} else {
		$sidebar_exists = false;
	}

	if( ! $sidebar_exists ) {
		$content_css = 'width:100%';
		$sidebar_css = 'display:none';
		$sidebar_exists = false;
	} elseif(get_post_meta($post->ID, 'pyre_sidebar_position', true) == 'left') {
		$content_css = 'float:right;';
		$sidebar_css = 'float:left;';
		$content_class = 'portfolio-one-sidebar';
		$sidebar_exists = true;
		$sidebar_left = 1;
	} elseif(get_post_meta($post->ID, 'pyre_sidebar_position', true) == 'right') {
		$content_css = 'float:left;';
		$sidebar_css = 'float:right;';
		$content_class = 'portfolio-one-sidebar';
		$sidebar_exists = true;
	} elseif(get_post_meta($post->ID, 'pyre_sidebar_position', true) == 'default'  || ! metadata_exists( 'post', $post->ID, 'pyre_sidebar_position' )) {
		$content_class = 'portfolio-one-sidebar';
		if($smof_data['default_sidebar_pos'] == 'Left') {
			$content_css = 'float:right;';
			$sidebar_css = 'float:left;';
			$sidebar_exists = true;
			$sidebar_left = 1;
		} elseif($smof_data['default_sidebar_pos'] == 'Right') {
			$content_css = 'float:left;';
			$sidebar_css = 'float:right;';
			$sidebar_exists = true;
			$sidebar_left = 2;
		}
	}

	if(get_post_meta($post->ID, 'pyre_sidebar_position', true) == 'right') {
		$sidebar_left = 2;
	}

	if($double_sidebars == true) {
		$content_css = 'float:left;';
		$sidebar_css = 'float:left;';
		$sidebar_2_css = 'float:left;';
	} else {
		$sidebar_left = 1;
	}

	if( $smof_data['pages_global_sidebar'] ) {
		if( $smof_data['pages_sidebar'] != 'None' ) {
			$sidebar_1 = $smof_data['pages_sidebar'];
		}

		if( $smof_data['pages_sidebar_2'] != 'None' ) {
			$sidebar_2 = $smof_data['pages_sidebar_2'];
		}
	} else {
		$sidebar_1 = '0';
		$sidebar_2 = '0';
	}
	?>
	<div id="content" class="portfolio portfolio-three portfolio-three-text portfolio-text <?php echo $content_class; ?>" style="<?php echo $content_css; ?>">
		<?php while(have_posts()): the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php echo avada_render_rich_snippets_for_pages(); ?>
			<div class="post-content">
				<?php the_content(); ?>
				<?php avada_link_pages(); ?>
			</div>
		</div>
		<?php $current_page_id = $post->ID; ?>
		<?php endwhile; ?>
		<?php
		if(is_front_page()) {
			$paged = (get_query_var('page')) ? get_query_var('page') : 1;
		} else {
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		}
		$args = array(
			'post_type' => 'avada_portfolio',
			'paged' => $paged,
			'posts_per_page' => $smof_data['portfolio_items'],
		);
		$pcats = get_post_meta(get_the_ID(), 'pyre_portfolio_category', true);
		if($pcats && $pcats[0] == 0) {
			unset($pcats[0]);
		}
		if($pcats){
			$args['tax_query'][] = array(
				'taxonomy' => 'portfolio_category',
				'field' => 'term_id',
				'terms' => $pcats
			);
		}
		$gallery = new WP_Query($args);
		$portfolio_taxs = array();
		if(is_array($gallery->posts) && !empty($gallery->posts)) {
			foreach($gallery->posts as $gallery_post) {
				$post_taxs = wp_get_post_terms($gallery_post->ID, 'portfolio_category', array("fields" => "all"));


				if(is_array($post_taxs) && !empty($post_taxs)) {
					foreach($post_taxs as $post_tax) {
						if(is_array($pcats) && !empty($pcats) && (in_array($post_tax->term_id, $pcats) || in_array($post_tax->parent, $pcats )) )  {
							$portfolio_taxs[urldecode($post_tax->slug)] = $post_tax->name;
						}

						if(empty($pcats) || !isset($pcats)) {
							$portfolio_taxs[urldecode($post_tax->slug)] = $post_tax->name;
						}
					}
				}
			}
		}

		$all_terms = get_terms('portfolio_category');
		if( !empty( $all_terms ) && is_array( $all_terms ) ) {
			foreach( $all_terms as $term ) {
			
				if( array_key_exists ( urldecode($term->slug) , $portfolio_taxs ) ) {
					$sorted_taxs[urldecode($term->slug)] = $term->name;
				}
			}
		}

		$portfolio_taxs = $sorted_taxs;

		$portfolio_category = get_terms('portfolio_category');
		if( ! post_password_required($post->ID) ):
		if(is_array($portfolio_taxs) && !empty($portfolio_taxs) && get_post_meta($post->ID, 'pyre_portfolio_filters', true) != 'no'):
		?>
		<ul class="portfolio-tabs clearfix">
			<li class="active"><a data-filter="*" href="#"><?php echo __('All', 'Avada'); ?></a></li>
			<?php foreach($portfolio_taxs as $portfolio_tax_slug => $portfolio_tax_name): ?>
			<li><a data-filter=".<?php echo $portfolio_tax_slug; ?>" href="#"><?php echo $portfolio_tax_name; ?></a></li>
			<?php endforeach; ?>
		</ul>
		<?php endif; ?>
		<?php
		if( ! get_post_meta($post->ID, 'pyre_portfolio_text_layout', true) || 
			get_post_meta($post->ID, 'pyre_portfolio_text_layout', true) == '' ||
			get_post_meta($post->ID, 'pyre_portfolio_text_layout', true) == 'default'
		) {
			$portfolio_text_layout = 'portfolio-' . $smof_data['portfolio_text_layout'] . ' ';
		} else {
			$portfolio_text_layout = 'portfolio-' . get_post_meta($post->ID, 'pyre_portfolio_text_layout', true) . ' ';
		}				
		?>		
		<div class="portfolio-wrapper">
			<?php
			while($gallery->have_posts()): $gallery->the_post();
				if($pcats) {
					$permalink = tf_addUrlParameter(get_permalink(), 'portfolioID', $current_page_id);
				} else {
					$permalink = get_permalink();
				}
				if(has_post_thumbnail() || get_post_meta($post->ID, 'pyre_video', true)):
			?>
			<?php
			$item_classes = $portfolio_text_layout;
			$item_cats = get_the_terms($post->ID, 'portfolio_category');
			if($item_cats):
			foreach($item_cats as $item_cat) {
				$item_classes .= urldecode($item_cat->slug) . ' ';
			}
			endif;
			
			$featured_image_size = avada_set_portfolio_image_size( $current_page_id );
			?>
			<div class="portfolio-item <?php echo $item_classes; ?>">
				<div class="portfolio-item-wrapper">
					<?php if(has_post_thumbnail()): ?>
					<div class="image" aria-haspopup="true">
						<?php if($smof_data['image_rollover']): ?>
						<?php the_post_thumbnail( $featured_image_size ); ?>
						<?php else: ?>
						<a href="<?php echo $permalink; ?>"><?php the_post_thumbnail( $featured_image_size ); ?></a>
						<?php endif; ?>
						<?php
						if(get_post_meta($post->ID, 'pyre_image_rollover_icons', true) == 'link') {
							$link_icon_css = 'display:inline-block;';
							$zoom_icon_css = 'display:none;';
						} elseif(get_post_meta($post->ID, 'pyre_image_rollover_icons', true) == 'zoom') {
							$link_icon_css = 'display:none;';
							$zoom_icon_css = 'display:inline-block;';
						} elseif(get_post_meta($post->ID, 'pyre_image_rollover_icons', true) == 'no') {
							$link_icon_css = 'display:none;';
							$zoom_icon_css = 'display:none;';
						} else {
							$link_icon_css = 'display:inline-block;';
							$zoom_icon_css = 'display:inline-block;';
						}

						$link_target = "";
						$icon_url_check = get_post_meta(get_the_ID(), 'pyre_link_icon_url', true); if(!empty($icon_url_check)) {
							$icon_permalink = get_post_meta($post->ID, 'pyre_link_icon_url', true);
							if(get_post_meta(get_the_ID(), 'pyre_link_icon_target', true) == "yes") {
								$link_target = ' target="_blank"';
							}
						} else {
							$icon_permalink = $permalink;
						}
						?>
						<div class="image-extras">
							<div class="image-extras-content">
								<?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full'); ?>
								<a style="<?php echo $link_icon_css; ?>" class="icon link-icon" href="<?php echo $icon_permalink; ?>"<?php echo $link_target; ?>>Permalink</a>
								<?php
								if(get_post_meta($post->ID, 'pyre_video_url', true)) {
									$full_image[0] = get_post_meta($post->ID, 'pyre_video_url', true);
								}
								?>
								<a style="<?php echo $zoom_icon_css; ?>" class="icon gallery-icon" href="<?php echo $full_image[0]; ?>" rel="prettyPhoto[gallery]" title="<?php echo get_post_field('post_excerpt', get_post_thumbnail_id($post->ID)); ?>"><img style="display:none;" alt="<?php echo get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true); ?>" />Gallery</a>
								<h3<?php if( ! $smof_data['disable_date_rich_snippet_pages'] ) { echo ' class="entry-title"'; } ?>><a href="<?php echo $icon_permalink; ?>"<?php echo $link_target; ?>><?php the_title(); ?></a></h3>
								<h4><?php echo get_the_term_list($post->ID, 'portfolio_category', '', ', ', ''); ?></h4>
							</div>
						</div>
					</div>
					<?php endif; ?>
					<div class="portfolio-content">
						<h2<?php if( ! $smof_data['disable_date_rich_snippet_pages'] ) { echo ' class="entry-title"'; } ?>><a href="<?php echo $permalink; ?>"><?php the_title(); ?></a></h2>
						<h4><?php echo get_the_term_list($post->ID, 'portfolio_category', '', ', ', ''); ?></h4>
						<?php if( ! $smof_data['disable_date_rich_snippet_pages'] ): ?>
						<span class="vcard" style="display: none;"><span class="fn"><?php the_author_posts_link(); ?></span></span>
						<span class="updated" style="display: none;"><?php the_modified_time( 'c' ); ?></span>
						<?php endif; ?>
						<?php if( $smof_data['portfolio_text_layout'] ): ?>
						<div class="content-sep"></div>
						<?php endif; ?>
						<div class="post-content">
						<?php
						if(get_post_meta($current_page_id, 'pyre_portfolio_excerpt', true)) {
							$excerpt_length = get_post_meta($current_page_id, 'pyre_portfolio_excerpt', true);
						} else {
							$excerpt_length = $smof_data['excerpt_length_portfolio'];
						}
						?>
						<?php
						if( ( $smof_data['portfolio_content_length'] == 'Excerpt' && get_post_meta($current_page_id, 'pyre_portfolio_content_length', true) != 'full_content' ) ||
							get_post_meta($current_page_id, 'pyre_portfolio_content_length', true) == 'excerpt'
						) {
							$stripped_content = strip_shortcodes( tf_content( $excerpt_length, $smof_data['strip_html_excerpt'] ) );
							echo $stripped_content;
						} else {
							the_content();
						}
						?>
						</div>
					</div>
				</div>
			</div>
			<?php endif; endwhile; ?>
		</div>
		<?php themefusion_pagination($gallery->max_num_pages, $range = 2); ?>
		<?php endif; ?>
	</div>
	<?php if( $sidebar_exists == true ): ?>
	<?php wp_reset_query(); ?>
	<div id="sidebar" class="sidebar" style="<?php echo $sidebar_css; ?>">
		<?php
		if($sidebar_left == 1) {
			generated_dynamic_sidebar($sidebar_1);
		}
		if($sidebar_left == 2) {
			generated_dynamic_sidebar_2($sidebar_2);
		}
		?>
	</div>
	<?php if( $double_sidebars == true ): ?>
	<div id="sidebar-2" class="sidebar" style="<?php echo $sidebar_2_css; ?>">
		<?php
		if($sidebar_left == 1) {
			generated_dynamic_sidebar_2($sidebar_2);
		}
		if($sidebar_left == 2) {
			generated_dynamic_sidebar($sidebar_1);
		}
		?>
	</div>
	<?php endif; ?>
	<?php endif; ?>
<?php get_footer(); ?>