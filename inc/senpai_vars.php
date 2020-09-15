<?php

//prevent direct access
if ( ! defined( 'ABSPATH' ) ) exit;


function senpai_posts_per_page( $query ) {
    if ( is_admin() || ! $query->is_main_query() ) {
       return;
    }

    if ( is_post_type_archive( 'project' ) ) {
       $query->set( 'posts_per_page', 6 );
    }
}
add_filter( 'pre_get_posts', 'senpai_posts_per_page' );