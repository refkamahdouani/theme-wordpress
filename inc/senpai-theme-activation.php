<?php

//prevent direct access
if ( ! defined( 'ABSPATH' ) ) exit;

add_action('after_switch_theme', 'senpai_activation');

function senpai_activation () {
    error_log('senpai theme activated');
    global $wpdb;
    
    $table_name = $wpdb->prefix . "users_log"; 
    
    $charset_collate = $wpdb->get_charset_collate();
    
    $sql = "CREATE TABLE $table_name (
      id mediumint(9) NOT NULL AUTO_INCREMENT,
      time_in datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
      time_out datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
      user_id mediumint(9) NOT NULL,
      status tinytext NOT NULL,
      name tinytext NOT NULL,
      email text NOT NULL,
      PRIMARY KEY  (id)
    ) $charset_collate;";
    
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );


    $table_name_contact = $wpdb->prefix . 'contact';

    $sql_contact = "CREATE TABLE $table_name_contact (
      id mediumint(9) NOT NULL AUTO_INCREMENT,
      time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
      name tinytext NOT NULL,
      email text NOT NULL,
      msg text NOT NULL,
      PRIMARY KEY  (id)
    ) $charset_collate;";

  dbDelta( $sql_contact );
}