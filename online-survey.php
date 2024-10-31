<?php
/*
Plugin Name: Online Survey Plugin
Plugin URI: https://themeperch.net/online-survey
Description: Once prospect fills the form and submit, Client will get the form in email with the answers and will be a link in the admin panel to view the survey.
Version: 1.0
Author: Themeperch
Author URI: https://themeperch.net/
*/

// don't load directly
if (!function_exists('is_admin')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}


define( 'ONLINE_SURVEY_VER', '1.0.1' );
define( 'ONLINE_SURVEY_PLUGIN', __FILE__ );
define( 'ONLINE_SURVEY_URI', trailingslashit(plugin_dir_url( __FILE__ )) );
define( 'ONLINE_SURVEY_ASSETS', trailingslashit(ONLINE_SURVEY_URI.'assets') );
define( 'ONLINE_SURVEY_DIR', trailingslashit(plugin_dir_path( __FILE__ )) );
define( 'ONLINE_SURVEY_TEMPLATEPATH', trailingslashit(plugin_dir_path( __FILE__ ).'templates') );

if ( ! defined( 'RWMB_VER' ) ) {
	require __DIR__ . '/vendor/wpmetabox/meta-box/meta-box.php';
}

if(!function_exists('online_servey_init')){
	add_action('init', 'online_servey_init', 1);
	function online_servey_init(){
		
		require __DIR__ . '/vendor/autoload.php';
		load_plugin_textdomain( 'online-survey', ONLINE_SURVEY_DIR . '/lang', basename( dirname( __FILE__ ) ) . '/lang' );
		new OnlineSurvey\Loader;
	}
}