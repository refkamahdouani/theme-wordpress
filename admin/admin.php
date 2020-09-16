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
                'id'    => 'wedevs_advanced',
                'title' => __( 'Advanced Settings', 'wp-crazy-senpai' )
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
                    'name'              => 'text_val',
                    'label'             => __( 'Text Input', 'wedevs' ),
                    'desc'              => __( 'Text input description', 'wedevs' ),
                    'placeholder'       => __( 'Text Input placeholder', 'wedevs' ),
                    'type'              => 'text',
                    'default'           => 'Title',
                    'sanitize_callback' => 'sanitize_text_field'
                ),
                array(
                    'name'              => 'number_input',
                    'label'             => __( 'Number Input', 'wedevs' ),
                    'desc'              => __( 'Number field with validation callback `floatval`', 'wedevs' ),
                    'placeholder'       => __( '1.99', 'wedevs' ),
                    'min'               => 0,
                    'max'               => 100,
                    'step'              => '0.01',
                    'type'              => 'number',
                    'default'           => 'Title',
                    'sanitize_callback' => 'floatval'
                ),
                array(
                    'name'        => 'textarea',
                    'label'       => __( 'Textarea Input', 'wedevs' ),
                    'desc'        => __( 'Textarea description', 'wedevs' ),
                    'placeholder' => __( 'Textarea placeholder', 'wedevs' ),
                    'type'        => 'textarea'
                ),
                array(
                    'name'        => 'html',
                    'desc'        => __( 'HTML area description. You can use any <strong>bold</strong> or other HTML elements.', 'wedevs' ),
                    'type'        => 'html'
                ),
                array(
                    'name'  => 'checkbox',
                    'label' => __( 'Checkbox', 'wedevs' ),
                    'desc'  => __( 'Checkbox Label', 'wedevs' ),
                    'type'  => 'checkbox'
                ),
                array(
                    'name'    => 'radio',
                    'label'   => __( 'Radio Button', 'wedevs' ),
                    'desc'    => __( 'A radio button', 'wedevs' ),
                    'type'    => 'radio',
                    'options' => array(
                        'yes' => 'Yes',
                        'no'  => 'No'
                    )
                ),
                array(
                    'name'    => 'selectbox',
                    'label'   => __( 'A Dropdown', 'wedevs' ),
                    'desc'    => __( 'Dropdown description', 'wedevs' ),
                    'type'    => 'select',
                    'default' => 'no',
                    'options' => array(
                        'yes' => 'Yes',
                        'no'  => 'No'
                    )
                ),
                array(
                    'name'    => 'password',
                    'label'   => __( 'Password', 'wedevs' ),
                    'desc'    => __( 'Password description', 'wedevs' ),
                    'type'    => 'password',
                    'default' => ''
                ),
                array(
                    'name'    => 'file',
                    'label'   => __( 'File', 'wedevs' ),
                    'desc'    => __( 'File description', 'wedevs' ),
                    'type'    => 'file',
                    'default' => '',
                    'options' => array(
                        'button_label' => 'Choose Image'
                    )
                )
            ),
            'wedevs_advanced' => array(
                array(
                    'name'    => 'color',
                    'label'   => __( 'Color', 'wedevs' ),
                    'desc'    => __( 'Color description', 'wedevs' ),
                    'type'    => 'color',
                    'default' => ''
                ),
                array(
                    'name'    => 'password',
                    'label'   => __( 'Password', 'wedevs' ),
                    'desc'    => __( 'Password description', 'wedevs' ),
                    'type'    => 'password',
                    'default' => ''
                ),
                array(
                    'name'    => 'wysiwyg',
                    'label'   => __( 'Advanced Editor', 'wedevs' ),
                    'desc'    => __( 'WP_Editor description', 'wedevs' ),
                    'type'    => 'wysiwyg',
                    'default' => ''
                ),
                array(
                    'name'    => 'multicheck',
                    'label'   => __( 'Multile checkbox', 'wedevs' ),
                    'desc'    => __( 'Multi checkbox description', 'wedevs' ),
                    'type'    => 'multicheck',
                    'default' => array('one' => 'one', 'four' => 'four'),
                    'options' => array(
                        'one'   => 'One',
                        'two'   => 'Two',
                        'three' => 'Three',
                        'four'  => 'Four'
                    )
                ),
            ),
            'senpai_fallback_background' => array(
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
                    'name'    => 'post-default-img',
                    'label'   => __( 'Post default image', 'wp-crazy-senpai' ),
                    'desc'    => __( 'fallback post image.', 'wp-crazy-senpai' ),
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
