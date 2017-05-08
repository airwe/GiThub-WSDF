<?php get_header(); ?>
	<?php
	$content_css = '';
	$content_class = '';
	$sidebar_css = '';
	$sidebar_exists = false;
	$sidebar_left = '';
	$double_sidebars = false;

	if( $smof_data['bbpress_global_sidebar'] ) {
		$sidebar_1 = $smof_data['ppbress_sidebar'];
		$sidebar_2 = $smof_data['ppbress_sidebar_2'];

		if( $sidebar_1 != 'None' && 
			$sidebar_2 != 'None' 
		) {
			$double_sidebars = true;
		}

		if( $sidebar_1 != 'None' ) {
			$sidebar_exists = true;
		} else {
			$sidebar_exists = false;
		}
		
	} else {
		$sidebar_1 = false;
		$sidebar_2 = false;	
	}

	$page_option_sidebar_1 = get_post_meta( $post->ID, 'sbg_selected_sidebar_replacement', true );
	$page_option_sidebar_2 = get_post_meta( $post->ID, 'sbg_selected_sidebar_2_replacement', true );

	/*if( $smof_data['bbpress_global_sidebar'] ) {
		if( $smof_data['ppbress_sidebar'] != 'None' ) {
			$page_option_sidebar_1 = array( $smof_data['ppbress_sidebar'] );
		} else {
			$page_option_sidebar_1 = '';
		}

		if( $smof_data['ppbress_sidebar_2'] != 'None' ) {
			$page_option_sidebar_2 = array( $smof_data['ppbress_sidebar_2'] );
		} else {
			$page_option_sidebar_2 = '';
		}
	}*/

	if( $page_option_sidebar_1 !== false || $page_option_sidebar_2 !== false ) {

		if( ( is_array( $page_option_sidebar_1 ) && $page_option_sidebar_1[0] ) && 
			( is_array( $page_option_sidebar_2 ) && $page_option_sidebar_2[0] ) 
		) {
			$double_sidebars = true;
		} else if( ( is_array( $page_option_sidebar_1 ) && $page_option_sidebar_1[0] ) &&
			$page_option_sidebar_2 == '' &&
			$smof_data['bbpress_global_sidebar'] && 
			$sidebar_2 != 'None' 
		) {
			$double_sidebars = true;
		} else {
			$double_sidebars = false;
		}

		if( is_array( $page_option_sidebar_1 ) && 
			$page_option_sidebar_1[0] 
		) {
			$sidebar_exists = true;
		} else if( $page_option_sidebar_1 == '' &&
				   $smof_data['bbpress_global_sidebar'] && 
				   $sidebar_1 != 'None' 
		) {			
			$sidebar_exists = true;
		} else {
			$sidebar_exists = false;
		}

		if( is_array( $page_option_sidebar_1 ) && 
			$page_option_sidebar_1[0] != 'Blog Sidebar' 
		) {
			$sidebar_1 = $page_option_sidebar_1[0];
		}
		
		if( ! $smof_data['bbpress_global_sidebar'] &&
			is_array( $page_option_sidebar_1 )
		) {	
			$sidebar_1 = $page_option_sidebar_1[0];
		}
		
		if( is_array( $page_option_sidebar_2 ) && 
			$page_option_sidebar_2[0] != 'Blog Sidebar' 
		) {
			$sidebar_2 = $page_option_sidebar_2[0];
		}
		
		if( ! $smof_data['bbpress_global_sidebar'] &&
			is_array( $page_option_sidebar_2 )
		) {	
			$sidebar_2 = $page_option_sidebar_2[0];
		}		
	}

	if( ( $sidebar_1 && $sidebar_1 != '' && $sidebar_1 != 'None' ) && ( $sidebar_2 && $sidebar_2 != '' && $sidebar_2 != 'None' ) ) {
		$double_sidebars = true;
	}

	if( $smof_data['bbpress_global_sidebar'] ) {
		if( $sidebar_1 == 'None' && is_array( $page_option_sidebar_1 ) && $page_option_sidebar_1[0] == 'Blog Sidebar' ) {
			$sidebar_exists = false;
		}

		if( $sidebar_2 == 'None' && is_array( $page_option_sidebar_2 ) && $page_option_sidebar_2[0] == 'Blog Sidebar' ) {
			$double_sidebars = false;
		}
	}

	if( is_bbpress() && bbp_is_forum_archive() ) {
		$sidebar_1 = $smof_data['ppbress_sidebar'];
		if( $sidebar_1 && $sidebar_1 != 'None') {
			$sidebar_exists = true;
		}
		$sidebar_2 = $smof_data['ppbress_sidebar_2'];
		if( $sidebar_2 && $sidebar_2 != 'None') {
			$double_sidebars = true;
		}
	}

	if( ! $sidebar_exists ) {
		$content_css = 'width:100%';
		$sidebar_css = 'display:none';
		$sidebar_exists = false;
	} elseif(get_post_meta($post->ID, 'pyre_sidebar_position', true) == 'left') {
		$content_css = 'float:right;';
		$sidebar_css = 'float:left;';
		$sidebar_left = 1;
	} elseif(get_post_meta($post->ID, 'pyre_sidebar_position', true) == 'right') {
		$content_css = 'float:left;';
		$sidebar_css = 'float:right;';
	} elseif( get_post_meta($post->ID, 'pyre_sidebar_position', true) == 'default' ||
			  get_post_meta($post->ID, 'pyre_sidebar_position', true) == '' 
	) {
		if($smof_data['default_sidebar_pos'] == 'Left') {
			$content_css = 'float:right;';
			$sidebar_css = 'float:left;';
			$sidebar_left = 1;
		} elseif($smof_data['default_sidebar_pos'] == 'Right') {
			$content_css = 'float:left;';
			$sidebar_css = 'float:right;';
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

	/*if( $smof_data['bbpress_global_sidebar'] ) {
		if( $smof_data['ppbress_sidebar'] != 'None' ) {
			$sidebar_1 = $smof_data['ppbress_sidebar'];
		}

		if( $smof_data['ppbress_sidebar_2'] != 'None' ) {
			$sidebar_2 = $smof_data['ppbress_sidebar_2'];
		}
	} else {
		$sidebar_1 = '0';
		$sidebar_2 = '0';
	}*/

	if( $sidebar_exists == false ) {
		$content_css = 'width:100%;';
		$sidebar_css = 'display:none;';
		$sidebar_2_css = 'display: none;';
		$sidebar_exists = false;
	}
	?>
	<div id="content" class="<?php echo $content_class; ?>" style="<?php echo $content_css; ?>">
		<?php
		if(have_posts()): the_post();
		?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php echo avada_render_rich_snippets_for_pages(); ?>			
			<?php if( ! post_password_required($post->ID) ): ?>
			<?php if(!$smof_data['featured_images_pages'] && has_post_thumbnail()): ?>
			<div class="image">
				<?php the_post_thumbnail('blog-large'); ?>
			</div>
			<?php endif; ?>
			<?php endif; // password check ?>
			<div class="post-content">
				<?php the_content(); ?>
				<?php avada_link_pages(); ?>
			</div>
			<?php if( ! post_password_required($post->ID) ): ?>
			<?php if(class_exists('Woocommerce')): ?>
			<?php if($smof_data['comments_pages'] && !is_cart() && !is_checkout() && !is_account_page() && !is_page(get_option('woocommerce_thanks_page_id'))): ?>
				<?php
				wp_reset_query();
				comments_template();
				?>
			<?php endif; ?>
			<?php else: ?>
			<?php if($smof_data['comments_pages']): ?>
				<?php
				wp_reset_query();
				comments_template();
				?>
			<?php endif; ?>
			<?php endif; ?>
			<?php endif; // password check ?>
		</div>
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