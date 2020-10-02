<?php

//prevent direct access
if ( ! defined( 'ABSPATH' ) ) exit;

// Let us create Taxonomy for Custom Post Type
add_action( 'init', 'senpai_custom_taxonomy', 0 );
 
//create a custom taxonomy name it "type" for your posts
function senpai_custom_taxonomy() {
 
  $labels = array(
    'name' => _x( 'Types', 'taxonomy general name' ),
    'singular_name' => _x( 'Type', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Types' ),
    'all_items' => __( 'All Types' ),
    'parent_item' => __( 'Parent Type' ),
    'parent_item_colon' => __( 'Parent Type:' ),
    'edit_item' => __( 'Edit Type' ), 
    'update_item' => __( 'Update Type' ),
    'add_new_item' => __( 'Add New Type' ),
    'new_item_name' => __( 'New Type Name' ),
    'menu_name' => __( 'Types' ),
  ); 	
 
  register_taxonomy('types',array('project'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_in_rest' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'type' ),
  ));


  $labels_users = array(
    'name'                       => _x( 'Departments', 'Departments Name', 'wp-crazy-senpai' ),
    'singular_name'              => _x( 'Department', 'Department Name', 'wp-crazy-senpai' ),
    'menu_name'                  => __( 'Departments', 'wp-crazy-senpai' ),
    'all_items'                  => __( 'All Departments', 'wp-crazy-senpai' ),
    'parent_item'                => __( 'Parent Department', 'wp-crazy-senpai' ),
    'parent_item_colon'          => __( 'Parent Department:', 'wp-crazy-senpai' ),
    'new_item_name'              => __( 'New Department Name', 'wp-crazy-senpai' ),
    'add_new_item'               => __( 'Add Department', 'wp-crazy-senpai' ),
    'edit_item'                  => __( 'Edit Department', 'wp-crazy-senpai' ),
    'update_item'                => __( 'Update Department', 'wp-crazy-senpai' ),
    'view_item'                  => __( 'View Department', 'wp-crazy-senpai' ),
    'separate_items_with_commas' => __( 'Separate department with commas', 'wp-crazy-senpai' ),
    'add_or_remove_items'        => __( 'Add or remove departments', 'wp-crazy-senpai' ),
    'choose_from_most_used'      => __( 'Choose from the most used', 'wp-crazy-senpai' ),
    'popular_items'              => __( 'Popular Departments', 'wp-crazy-senpai' ),
    'search_items'               => __( 'Search Departments', 'wp-crazy-senpai' ),
    'not_found'                  => __( 'Not Found', 'wp-crazy-senpai' ),
    'no_terms'                   => __( 'No departments', 'wp-crazy-senpai' ),
    'items_list'                 => __( 'Departments list', 'wp-crazy-senpai' ),
    'items_list_navigation'      => __( 'Departments list navigation', 'wp-crazy-senpai' ),
  );
  $args_users = array(
    'labels'                     => $labels_users,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'query_var'                  => true,
    'show_tagcloud'              => true,
  );
  register_taxonomy( 'departments', 'user', $args_users );

}

#https://codebriefly.com/how-to-create-taxonomy-for-users-in-wordpress/


 /**
 * Admin page for the 'departments' taxonomy
 */
function cb_add_departments_taxonomy_admin_page() {
  $tax = get_taxonomy( 'departments' );
  add_users_page(
    esc_attr( $tax->labels->menu_name ),
    esc_attr( $tax->labels->menu_name ),
    $tax->cap->manage_terms,
    'edit-tags.php?taxonomy=' . $tax->name
  );
}
add_action( 'admin_menu', 'cb_add_departments_taxonomy_admin_page' );

/**
 * Unsets the 'posts' column and adds a 'users' column on the manage departments admin page.
 */
function cb_manage_departments_user_column( $columns ) {
  unset( $columns['posts'] );
  $columns['users'] = __( 'Users' );
  return $columns;
}
add_filter( 'manage_edit-departments_columns', 'cb_manage_departments_user_column' );

/**
 * @param string $display WP just passes an empty string here.
 * @param string $column The name of the custom column.
 * @param int $term_id The ID of the term being displayed in the table.
 */
function cb_manage_departments_column( $display, $column, $term_id ) {
  if ( 'users' === $column ) {
    $term = get_term( $term_id, 'departments' );
    echo $term->count;
  }
}
add_filter( 'manage_departments_custom_column', 'cb_manage_departments_column', 10, 3 );

/**
 * @param object $user The user object currently being edited.
 */
function cb_edit_user_department_section( $user ) {
  global $pagenow;
  $tax = get_taxonomy( 'departments' );
  /* Make sure the user can assign terms of the departments taxonomy before proceeding. */
  if ( !current_user_can( $tax->cap->assign_terms ) )
    return;
  /* Get the terms of the 'departments' taxonomy. */
  $terms = get_terms( 'departments', array( 'hide_empty' => false ) ); ?>
  <h3><?php _e( 'Departments' ); ?></h3>
  <table class="form-table">
    <tr>
      <th><label for="departments"><?php _e( 'Allocated Departments' ); ?></label></th>
      <td><?php
      /* If there are any departments terms, loop through them and display checkboxes. */
      if ( !empty( $terms ) ) {
        foreach ( $terms as $term ) { 
        ?>
          <label for="departments-<?php echo esc_attr( $term->slug ); ?>">
            <input type="checkbox" name="departments[]" id="departments-<?php echo esc_attr( $term->slug ); ?>" value="<?php echo $term->slug; ?>" <?php if ( $pagenow !== 'user-new.php' ) checked( true, is_object_in_term( $user->ID, 'departments', $term->slug ) ); ?>>
            <?php echo $term->name; ?>
          </label><br/>
        <?php
        }
      }
      /* If there are no departments terms, display a message. */
      else {
        _e( 'There are no departments available.' );
      }
      ?></td>
    </tr>
  </table>
<?php }
add_action( 'show_user_profile', 'cb_edit_user_department_section' );
add_action( 'edit_user_profile', 'cb_edit_user_department_section' );
add_action( 'user_new_form', 'cb_edit_user_department_section' );


/**
 * @param int $user_id The ID of the user to save the terms for.
 */
function cb_save_user_department_terms( $user_id ) {
  $tax = get_taxonomy( 'departments' );
  /* Make sure the current user can edit the user and assign terms before proceeding. */
  if ( !current_user_can( 'edit_user', $user_id ) && current_user_can( $tax->cap->assign_terms ) )
    return false;
  $term = $_POST['departments'];
  /* Sets the terms (we're just using a single term) for the user. */
  wp_set_object_terms( $user_id, $term, 'departments', false);
  clean_object_term_cache( $user_id, 'departments' );
}
add_action( 'personal_options_update', 'cb_save_user_department_terms' );
add_action( 'edit_user_profile_update', 'cb_save_user_department_terms' );
add_action( 'user_register', 'cb_save_user_department_terms' );