<?php

//prevent direct access
if ( ! defined( 'ABSPATH' ) ) exit;

//redirect error logs to /logs/all-debug.log
ini_set( 'error_log', get_template_directory() . '/logs/all-debug.log' );

//require get_template_directory() . '/vendor/autoload.php';
require get_template_directory() . '/inc/theme-class.php';

$senpai = new SenpaiTheme;

//senpai Nav walker
function register_navwalker(){
	require_once get_template_directory() . '/inc/senpai-nav-walker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );

//Register nav menu
$senpai->addNavMenus(['menu-1' => 'Primary',]);

/// Styles and Scripts
$senpai->addStyle('plugin-css',  get_template_directory_uri() . '/assets/css/plugins.min.css', array(), false,'all');
$senpai->addStyle('custom-css',  get_template_directory_uri() . '/assets/css/style_one.css', array('plugin-css'), false,'all');

$senpai->addScript('jq-js',  get_template_directory_uri() . '/assets/vendors/jquery-1.12.0.min.js',  array(), false, true);
$senpai->addScript('plugin-js',  get_template_directory_uri() . '/assets/scripts/plugins.min.js',  array(), false, true);
$senpai->addScript('main-js',  get_template_directory_uri() . '/assets/scripts/scripts.js',  array('jq-js', 'plugin-js'), false, true);

//Custom Post types
require_once get_template_directory() . '/inc/senpai-cpt.php';

//Custom Post types Taxanomies
require_once get_template_directory() . '/inc/senpai-tax.php';

//Settings Page
require_once get_template_directory() . '/inc/senpai-settings.php';