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

function senpai_img_sizes_theme() {
   //add_theme_support( 'post-thumbnails' );
   add_image_size( 'team-thumb', 60, 60, true );
}
 
add_action( 'after_setup_theme', 'senpai_img_sizes_theme' );