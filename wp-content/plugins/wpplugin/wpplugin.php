<?php

/*
Plugin Name: Wpplugin
Plugin URI: https://github.com/alieveldar/wp_plugin_test.git
Description: Plugin that displays content on site pages.
Version: 1.0
Author: Eldar Aliev
Author URI: https://alieveldar.github.io/
License: free
*/
if ( ! function_exists( 'add_action' ) ) {
	echo 'This code can only be called as a WordPress plugin';
	exit;
}

define( 'WPPLUGIN_NUMER_OF_RECORDS', 3 );
define( 'WPPLUGIN_SORT_OF_RECORDS', 'ASC' );
define( 'WPPLUGIN__DIR', plugin_dir_path( __FILE__ ) );
define( 'WPPLUGIN_RECORDS_TYPE_POST', 'post' );
define( 'WPPLUGIN_RECORDS_TYPE_PAGE', 'page' );
define( 'WPPLUGIN_RECORDS_TYPE', WPPLUGIN_RECORDS_TYPE_POST );
require_once( WPPLUGIN__DIR . 'class.wpplugin.php' );
new WpPlugin();