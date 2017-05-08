<?php   
    /* 
    Plugin Name: Advanced Twitter Feed Integration
    Plugin URI: https://www.creare.co.uk/services/advanced-twitter-feed-integration
    Description: Enter your Twitter API credentials and then display your recent tweets on your website
    Author: CreareGroup
    Version: 0.3
    Author URI: http://www.creare.co.uk/
    */   


	/*  Copyright 2013  CREAREGROUP  (email : rob.kent@creare.co.uk)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
	*/

define('ATFI_DIR',plugin_dir_path( __FILE__ ));
define('ATFI_URL',plugin_dir_url( __FILE__ ));

require_once('inc/creare_twitter.php');
require_once('inc/widget.php');
require_once('inc/search_widget.php');
require_once('inc/shorttags.php');
require_once('inc/ajax-functions.php');

if ( is_admin() ){ 
	add_action('admin_menu', 'atfi_admin_actions');   
	add_action('admin_init', 'atfi_theme_options_init' );  
}

function atfi_admin_actions() { 
    $page = add_options_page("ATFI Options", "Advanced Twitter Feed Integration", "administrator", "atfi", "atfi_admin"); 

}

function atfi_theme_options_init(){
    register_setting( 'atfi_option_group', 'atfi_consumer_key' );
    register_setting( 'atfi_option_group', 'atfi_consumer_secret' );
    register_setting( 'atfi_option_group', 'atfi_access_token' );
    register_setting( 'atfi_option_group', 'atfi_access_token_secret' );
} 

function atfi_admin() {  
    include('advanced-twitter-feed-integration-settings.php'); 
}

add_action( 'wp_enqueue_scripts', 'atfi_styles' );

function atfi_styles() { 
    wp_register_style('atfi', ATFI_URL.'css/styles.css','',null,'all');
    wp_enqueue_style('atfi');
}

function register_atfi_widget() {
    register_widget( 'Advanced_Twitter_Feed_Integration_Widget' );
    register_widget( 'Advanced_Twitter_Feed_Integration_Search_Widget' );
}
add_action( 'widgets_init', 'register_atfi_widget' );

function atfi_settings_link($links, $file) {
    $plugin_file = basename(__FILE__);
    if (basename($file) == $plugin_file) {
        $settings_link = '<a href="options-general.php?page=atfi">Settings</a>';
        array_unshift($links, $settings_link);
    }
    return $links;
}
add_filter('plugin_action_links', 'atfi_settings_link', 10, 2);