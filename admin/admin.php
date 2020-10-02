<?php


if ( !class_exists('WeDevs_Settings_API_Test' ) ):
class WeDevs_Settings_API_Test {

    private $settings_api;

    function __construct() {
        $this->settings_api = new WeDevs_Settings_API;

        add_action( 'admin_init', array($this, 'admin_init') );
        add_action( 'admin_menu', array($this, 'admin_menu') );
    }

    function admin_init() {

        //set the settings
        $this->settings_api->set_sections( $this->get_settings_sections() );
        $this->settings_api->set_fields( $this->get_settings_fields() );

        //initialize settings
        $this->settings_api->admin_init();
    }

    function admin_menu() {
        add_options_page( 
            'Senpai Options', 
            'Senpai Options', 
            'delete_posts', 
            'senpai-options', 
            array($this, 'plugin_page') );
            add_menu_page(
                'Senpai Options', // page_title
                'Senpai Options', // menu_title
                'manage_options', // capability
                'senpai-options', // menu_slug
                array($this, 'plugin_page'), // function
                'dashicons-admin-generic', // icon_url
                3 // position
            );
    }

    function get_settings_sections() {
        $sections = array(
            array(
                'id'    => 'wedevs_basics',
                'title' => __( 'Basic Settings', 'wp-crazy-senpai' )
            ),
            array(
                'id'    => 'senpai_fallback_background',
                'title' => __( 'Fallback Backgrounds', 'wp-crazy-senpai' )
            )
        );
        return $sections;
    }

    /**
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    function get_settings_fields() {
        $settings_fields = array(
            'wedevs_basics' => array(
                array(
                    'name'    => 'logo',
                    'label'   => __( 'Company Logo', 'wp-crazy-senpai' ),
                    'desc'    => __( 'Comapy logo for html & mails', 'wp-crazy-senpai' ),
                    'type'    => 'file',
                    'default' => '',
                    'options' => array(
                        'button_label' => 'Choose Image'
                    )
                ),
                array(
                    'name'        => 'location',
                    'type'    => 'wysiwyg',
                    'label'       => __( 'location', 'wp-crazy-senpai' ),
                    'desc'        => __( '', 'wp-crazy-senpai' ),
                    'placeholder' => __( 'your location goes here', 'wp-crazy-senpai' )
                ),
                array(
                    'name'        => 'phones',

                    'type'    => 'wysiwyg',
                    'label'       => __( 'phones', 'wp-crazy-senpai' ),
                    'desc'        => __( '', 'wp-crazy-senpai' ),
                    'placeholder' => __( 'your phones goes here', 'wp-crazy-senpai' )
                ),

                array(
                    'name'        => 'emails',
                    'type'    => 'wysiwyg',
                    'label'       => __( 'emails', 'wp-crazy-senpai' ),
                    'desc'        => __( '', 'wp-crazy-senpai' ),
                    'placeholder' => __( 'your emails goes here', 'wp-crazy-senpai' )
                ),
                array(
                    'name'        => 'social_media',
                    'type'    => 'wysiwyg',
                    'label'       => __( 'Social Media', 'wp-crazy-senpai' ),
                    'desc'        => __( '', 'wp-crazy-senpai' ),
                    'placeholder' => __( 'Socilas...', 'wp-crazy-senpai' )
                ),
                array(
                    'name'        => 'footer_credit',
                    'type'    => 'wysiwyg',
                    'label'       => __( 'Footer credits', 'wp-crazy-senpai' ),
                    'desc'        => __( '', 'wp-crazy-senpai' ),
                    'placeholder' => __( 'Footer Credits', 'wp-crazy-senpai' )
                ),

            ),
            'senpai_fallback_background' => array(
                array(
                    'name'    => 'user-avatar',
                    'label'   => __( 'User Avatar', 'wp-crazy-senpai' ),
                    'desc'    => __( 'User fallback avatar.', 'wp-crazy-senpai' ),
                    'type'    => 'file',
                    'default' => '',
                    'options' => array(
                        'button_label' => 'Choose Image'
                    )
                ),
                array(
                    'name'    => 'header-project',
                    'label'   => __( 'Project Header', 'wp-crazy-senpai' ),
                    'desc'    => __( 'Project archive header.', 'wp-crazy-senpai' ),
                    'type'    => 'file',
                    'default' => '',
                    'options' => array(
                        'button_label' => 'Choose Image'
                    )
                ),
                array(
                    'name'    => 'default-header',
                    'label'   => __( 'Default Header', 'wp-crazy-senpai' ),
                    'desc'    => __( 'fallback header.', 'wp-crazy-senpai' ),
                    'type'    => 'file',
                    'default' => '',
                    'options' => array(
                        'button_label' => 'Choose Image'
                    )
                ),

                array(
                    'name'    => 'default-header-blog',
                    'label'   => __( 'Default Blog Header', 'wp-crazy-senpai' ),
                    'desc'    => __( 'Blog fallback header.', 'wp-crazy-senpai' ),
                    'type'    => 'file',
                    'default' => '',
                    'options' => array(
                        'button_label' => 'Choose Image'
                    )
                ),
                array(
                    'name'    => 'default-footer',
                    'label'   => __( 'Default footer background', 'wp-crazy-senpai' ),
                    'desc'    => __( 'Footer fallback background.', 'wp-crazy-senpai' ),
                    'type'    => 'file',
                    'default' => '',
                    'options' => array(
                        'button_label' => 'Choose Image'
                    )
                ),
                array(
                    'name'    => 'project-default-poster',
                    'label'   => __( 'Project default poster', 'wp-crazy-senpai' ),
                    'desc'    => __( 'fallback project poster.', 'wp-crazy-senpai' ),
                    'type'    => 'file',
                    'default' => '',
                    'options' => array(
                        'button_label' => 'Choose Image'
                    )
                ),
                array(
                    'name'    => 'post-default-feature',
                    'label'   => __( 'Post default feautured image', 'wp-crazy-senpai' ),
                    'desc'    => __( '', 'wp-crazy-senpai' ),
                    'type'    => 'file',
                    'default' => '',
                    'options' => array(
                        'button_label' => 'Choose Image'
                    )
                ),
                array(
                    'name'    => '404-img',
                    'label'   => __( '404 default image', 'wp-crazy-senpai' ),
                    'desc'    => __( '404 image.', 'wp-crazy-senpai' ),
                    'type'    => 'file',
                    'default' => '',
                    'options' => array(
                        'button_label' => 'Choose Image'
                    )
                ),
            )
        );

        return $settings_fields;
    }

    function plugin_page() {
        echo '<div class="wrap">';
        echo '<h2 class="senpai-title">Senpai Codes Options</h2>';
        $this->settings_api->show_navigation();
        $this->settings_api->show_forms();

        echo '</div>';
    }

    /**
     * Get all the pages
     *
     * @return array page names with key value pairs
     */
    function get_pages() {
        $pages = get_pages();
        $pages_options = array();
        if ( $pages ) {
            foreach ($pages as $page) {
                $pages_options[$page->ID] = $page->post_title;
            }
        }

        return $pages_options;
    }

}
endif;



 /**
 * Enqueue a script in the WordPress admin on edit.php.
 *
 * @param int $hook Hook suffix for the current admin page.
 */
function senpai_selectively_enqueue_admin_script( $hook ) {
    error_log(print_r($hook,1));
    if ( 'toplevel_page_senpai-options' != $hook ) {
        return;
    }
    wp_enqueue_script( 'senpai_admin_script', get_template_directory_uri() . '/admin/admin.js', array('jquery'), '1.0' );
    wp_enqueue_style( 'senpai_admin_space_age', get_template_directory_uri() . '/assets/fonts/SpaceAge/style.css', false, '1.0.0','all');

    wp_enqueue_style( 'senpai_admin_css', get_template_directory_uri() . '/admin/admin.css', array('senpai_admin_space_age'), '1.0.0','all');
}
add_action( 'admin_enqueue_scripts', 'senpai_selectively_enqueue_admin_script' );


/**
 * 
 * Get Option for the front end side
 * 
 */

function wp_crazy_senpai_get_option( $option, $section, $default = '' ) {

    $options = get_option( $section );

    if ( isset( $options[$option] ) ) {
        return $options[$option];
    }

    return $default;
}
