<?php

//prevent direct access
if ( ! defined( 'ABSPATH' ) ) exit;

//https://codex.wordpress.org/Plugin_API/Action_Reference/wp_login
function senpai_login( $user_login, $user ) {
    // your code
    global $wpdb;

    //error_log(print_r($user_login,1));
    //error_log(print_r($user,1));


    $name = $user->data->display_name;
    $email = $user->data->user_email;
    $ID = $user->ID;
    $status = 'online';

	$table_name = $wpdb->prefix . 'users_log';

	$wpdb->insert( 
		$table_name, 
		array( 
			'time_in' => current_time( 'mysql' ), 
			'time_out' => current_time( 'mysql' ),
            'user_id'  => $ID,
            'status' => $status, 
			'name' => $name, 
            'email'  => $email
		) 
	);
}

add_action('wp_login', 'senpai_login', 10, 2);


function senpai_logout() {
    global $wpdb;
    $userinfo = wp_get_current_user();
    $ID =  $userinfo->ID;
    
    $table = $wpdb->prefix . 'users_log';
    $data = array( 
        'time_out' => current_time( 'mysql' ),
        'status' => 'offline'
    );
    $where = [ 'user_id' => $ID, 'status' => 'online' ];
    $updated = $wpdb->update( $table, $data, $where );
 
    if ( false === $updated ) {
        // There was an error.
        //error_log('logout fail');
    } else {
        // No error. You can check updated to see how many rows were changed.
        //error_log('logout');
    }
}
add_action('clear_auth_cookie', 'senpai_logout', 10);