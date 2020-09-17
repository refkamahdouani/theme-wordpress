<?php

//prevent direct access
if ( ! defined( 'ABSPATH' ) ) exit;

//composer support
require get_template_directory() . '/vendor/autoload.php';

//redirect error logs to /logs/all-debug.log
ini_set( 'error_log', get_template_directory() . '/logs/all-debug.log' );

//require get_template_directory() . '/vendor/autoload.php';
require get_template_directory() . '/inc/theme-class.php';

$senpai = new SenpaiTheme;



//SMTP
require_once get_template_directory() . '/inc/senpai_smtp.php';

/**
 * validation library
 * https://packagist.org/packages/rakit/validation 
 */

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
$senpai->addScript('main-senpai',  get_template_directory_uri() . '/assets/senpai/main-senpai.js',  array('jq-js', 'plugin-js'), false, true);


//$senpai->removeScript('comment-reply');

//Theme activation logic
require_once get_template_directory() . '/inc/senpai-theme-activation.php';

//Theme deactivation logic
require_once get_template_directory() . '/inc/senpai-theme-deactivation.php';

//login/logout logic
require_once get_template_directory() . '/inc/senpai-user-login.php';

//Custom Post types
require_once get_template_directory() . '/inc/senpai-cpt.php';

//Custom Post types Taxanomies
require_once get_template_directory() . '/inc/senpai-tax.php';



//Settings Page
require_once get_template_directory() . '/admin/admin.php';

$admin = new WeDevs_Settings_API_Test;

//Ajax Comment
require_once get_template_directory() . '/inc/senpai-ajax-comment.php';

//Ajax projects
require_once get_template_directory() . '/inc/senpai-ajax-projects.php';

//Ajax posts
require_once get_template_directory() . '/inc/senpai-ajax-posts.php';

//Ajax Contact
require_once get_template_directory() . '/inc/senpai-ajax-contact.php';


//Global Vars
require_once get_template_directory() . '/inc/senpai_vars.php';


//

//senpai-ajax-projects.php

//Show ID in the dashboard
require_once get_template_directory() . '/inc/senpai_id_dashboard.php';


//Send_mail($email,$name,$msg)
//$result = Send_mail('','','');
//error_log($result);



