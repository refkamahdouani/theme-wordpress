<?php

//prevent direct access
if ( ! defined( 'ABSPATH' ) ) exit;


// Hook senpai_custom_post_project() to the init action hook
add_action( 'init', 'senpai_custom_post_project' );
 
// The custom function to register a Project post type
function senpai_custom_post_project() {
 
  // Set the labels, this variable is used in the $args array
  $labels = array(
    'name'               => __( 'Projects' ),
    'singular_name'      => __( 'Project' ),
    'add_new'            => __( 'Add New Project' ),
    'add_new_item'       => __( 'Add New Project' ),
    'edit_item'          => __( 'Edit Project' ),
    'new_item'           => __( 'New Project' ),
    'all_items'          => __( 'All Projects' ),
    'view_item'          => __( 'View Project' ),
    'search_items'       => __( 'Search Projects' ),
    'featured_image'     => 'Poster',
    'set_featured_image' => 'Add Poster'
  );
 
  // The arguments for our post type, to be entered as parameter 2 of register_post_type()
  $args = array(
    'labels'            => $labels,
    'description'       => 'Holds our Projects and Project specific data',
    'public'            => true,
    'menu_position'     => 5,
    'supports'          => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'custom-fields' ),
    'has_archive'       => true,
    'show_in_admin_bar' => true,
    'show_in_nav_menus' => true,
    //'query_var'         => 'project',
    'show_in_rest' => true, //gutenburg enabled
    'menu_icon'           => 'dashicons-shortcode'
  );
 
    //https://developer.wordpress.org/resource/dashicons/#shortcode

  // Call the actual WordPress function
  // Parameter 1 is a name for the post type
  // Parameter 2 is the $args array
  register_post_type( 'project', $args, 0);
}
 