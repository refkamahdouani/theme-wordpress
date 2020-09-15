<?php

//prevent direct access
if ( ! defined( 'ABSPATH' ) ) exit;

add_action('switch_theme', 'senpai_deactivation');

function senpai_deactivation () {
    error_log('senpai theme deactivated');
    global $wpdb;
    $table_name = $wpdb->prefix . "users_log";
    $sql = "DROP TABLE IF EXISTS $table_name;";
    $wpdb->query($sql);
}