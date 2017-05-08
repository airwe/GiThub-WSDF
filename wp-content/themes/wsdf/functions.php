<?php
function avada_child_scripts() {
	if ( ! is_admin() && ! in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ) ) ) {
		$theme_info = wp_get_theme();
		wp_enqueue_style( 'avada-child-stylesheet', get_template_directory_uri() . '/style.css', array(), $theme_info->get( 'Version' ) );
	}
}
add_action('wp_enqueue_scripts', 'avada_child_scripts');

function wpa_filter_nav_menu_objects( $items ){
    foreach( $items as $key => $item ){
        if( 'Publications' == $item->title && !current_user_can( 'administrator' ) ){
            unset( $items[$key] );
        }
    }
    return $items;
}
add_filter( 'wp_nav_menu_objects', 'wpa_filter_nav_menu_objects' );