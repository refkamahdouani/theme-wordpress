<?php

//prevent direct access
if ( ! defined( 'ABSPATH' ) ) exit;

//$senpai->addScript( 'ajax_comment', get_stylesheet_directory_uri() . '/ajax-comment.js', array('jq-js') );

add_action( 'wp_enqueue_scripts', 'senpai_ajax_contact_scripts' );
 
function senpai_ajax_contact_scripts() {
    //global $post;
	// just register for now, we will enqueue it below
	wp_register_script( 'ajax_contact', get_stylesheet_directory_uri() . '/assets/senpai/ajax-contact.js', array('jq-js') );
 
	// let's pass ajaxurl here, you can do it directly in JavaScript but sometimes it can cause problems, so better is PHP
    
    //https://wordpress.stackexchange.com/questions/211831/get-the-current-post-id-as-a-variable-in-javascript/270143
    wp_localize_script( 'ajax_contact', 'senpai_ajax_contact_params', array(
        'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
        //'postID' => $post->ID,
        'nonce' => wp_create_nonce('ajax-contact-nonce')
	) );
 
 	wp_enqueue_script( 'ajax_contact' );
}


add_action( 'wp_ajax_ajaxcontact', 'senpai_submit_ajax_contact' ); // wp_ajax_{action} for registered user
add_action( 'wp_ajax_nopriv_ajaxcontact', 'senpai_submit_ajax_contact' ); // wp_ajax_nopriv_{action} for not registered users
 
function senpai_submit_ajax_contact(){
    $nonce = $_POST['nonce'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $msg = $_POST['msg'];

    if ( ! wp_verify_nonce( $nonce, 'ajax-contact-nonce' ) )
        die ( 'error');



	global $wpdb;

	$db_name = $name;
    $db_email = $email;
    $db_msg = $msg;

	$table_name = $wpdb->prefix . 'contact';

	$i = $wpdb->insert( 
		$table_name, 
		array( 
			'time' => current_time( 'mysql' ), 
			'name' => $db_name, 
            'email' => $db_email,
            'msg'  => $db_msg
		) 
	);

    $respond = array(
        'success' => $i
    );
    $output = json_encode($respond);

    echo $output;
 
	die();
}

