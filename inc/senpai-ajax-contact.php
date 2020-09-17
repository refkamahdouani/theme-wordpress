<?php

//prevent direct access
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * validation library
 * https://packagist.org/packages/rakit/validation 
 */
use Rakit\Validation\Validator;


//helper functions
function valid_email($str) {
    return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
    }
function valid_name($str) {
    return (!preg_match("/^[A-Za-z ,.]+$/i", $str)) ? FALSE : TRUE;
}
function valid_msg($str) {
    return (!preg_match("/^[a-z0-9 +-.,?]+$/i", $str)) ? FALSE : TRUE;
}



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
    $msg = $_POST['message'];

    if ( ! wp_verify_nonce( $nonce, 'ajax-contact-nonce' ) ){
        $respond = array(
            'success' => 0,
            'msg'=>'something went wrong'
        );
        $output = json_encode($respond);
        echo $output;
        die ();
    }

    /**
     * Validation Logic
     */
    $validator = new Validator;

    // make it
    $validation = $validator->make($_POST, [
        'name'                  => 'required|alpha_spaces',
        'email'                 => 'required|email',
        'message'               =>    'required|regex:/^[a-z0-9 +-.,?~!@#$%*]+$/i',
        'nonce'                 =>  'required',
    ]);
    
    // then validate
    $validation->validate();
    
    if ($validation->fails()) {
        // handling errors
        $errors = $validation->errors();
        $messages = $errors->firstOfAll(':message', false);
        $respond = array(
            'success' => 0,
            'msg'=> $messages
        );
        $output = json_encode($respond);
        echo $output;
        die ();
    }

    // Validation success, move on.

    //insert contaqct mail into the database
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

    //send mail using SMTP
    //Send_mail($email,$name,$msg)
    $smtp = Send_mail($db_email,$db_name,$db_msg);
    //error_log($result);


    $respond = array(
        'success' => $i,
        'email' => $smtp
    );
    $output = json_encode($respond);

    echo $output;
 
	die();
}

