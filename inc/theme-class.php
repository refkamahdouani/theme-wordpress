<?php
//prevent direct access
if ( ! defined( 'ABSPATH' ) ) exit;

class SenpaiTheme
{
    private function actionAfterSetup($function)
    {
        add_action('after_setup_theme', function() use ($function) {
            $function();
        });
    }

    private function actionWidgetsInit($function)
    {
        add_action('widgets_init', function() use ($function) {
            $function();
        });
    }

    private function actionEnqueueScripts($function)
    {
        add_action('wp_enqueue_scripts', function() use ($function){
            $function();
        });
    }

    public function __construct()
    {
        $this->addSupport('title-tag')
             ->addSupport('custom-logo')
             ->addSupport('post-thumbnails')
             ->addSupport('customize-selective-refresh-widgets')
             ->addSupport('html5', [
                 'search-form',
                 //'comment-form',
                 //'comment-list',
                 'gallery',
                 'caption'
             ])
             ->addStyle('theme-styles',  get_stylesheet_uri())
             ->addCommentScript();
    }

    public function addSupport($feature, $options = null)
    {
        $this->actionAfterSetup(function() use ($feature, $options) {
            if ($options){
                add_theme_support($feature, $options);
            } else {
                add_theme_support($feature);
            }
        });
        return $this;
    }

    public function addWidget($id, $name)
    {
        $this->actionWidgetsInit(function() use ($id, $name) {
            register_sidebar(
                array(
                    'name'          => esc_html__( $name, 'wp-senpai' ),
                    'id'            => $id,
                    'description'   => esc_html__( 'Add widgets here.', 'wp-senpai' ),
                    'before_widget' => '<section id="%1$s" class="senpai-widget %2$s">',
                    'after_widget'  => '</section>',
                    'before_title'  => '<h2 class="senpai-widget-title">',
                    'after_title'   => '</h2>',
                )
            );
        });
        return $this;
    }



    public function removeSupport($feature)
    {
        $this->actionAfterSetup(function() use ($feature){
            remove_theme_support($feature);
        });
        return $this;
    }

    public function loadTextDomain($domain, $path = false)
    {
        $this->actionAfterSetup(function() use ($domain, $path){
            load_theme_textdomain($domain, $path);
        });
        return $this;
    }

    public function addImageSize($name, $width = 0, $height = 0, $crop = false)
    {
        $this->actionAfterSetup(function() use ($name, $width, $height, $crop){
            add_image_size($name, $width, $height, $crop);
        });
        return $this;
    }

    public function removeImageSize($name)
    {
        $this->actionAfterSetup(function() use ($name){
            remove_image_size($name);
        });
        return $this;
    }

    public function addStyle($handle,  $src = '',  $deps = array(), $ver = false, $media = 'all')
    {
        $this->actionEnqueueScripts(function() use ($handle, $src, $deps, $ver, $media){
            wp_enqueue_style($handle,  $src,  $deps, $ver, $media);
        });
        return $this;
    }

    public function addScript($handle,  $src = '',  $deps = array(), $ver = false, $in_footer = false)
    {
        $this->actionEnqueueScripts(function() use ($handle, $src, $deps, $ver, $in_footer){
            wp_enqueue_script($handle,  $src,  $deps, $ver, $in_footer);
        });
        return $this;
    }

    public function addCommentScript()
    {
        $this->actionEnqueueScripts(function(){
            if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
                wp_enqueue_script( 'comment-reply' );
            }
        });
        return $this;
    }

    public function removeStyle($handle)
    {
        $this->actionEnqueueScripts(function() use ($handle){
            wp_dequeue_style($handle);
            wp_deregister_style($handle); 
        });
        return $this;
    }

    public function removeScript($handle)
    {
        $this->actionEnqueueScripts(function() use ($handle){
            wp_dequeue_script($handle);
            wp_deregister_script($handle);   
        });
        return $this;
    }

    public function addNavMenus($locations = array())
    {
        $this->actionAfterSetup(function() use ($locations){
            register_nav_menus($locations);
        });
        return $this;
    }

    public function addNavMenu($location, $description)
    {
        $this->actionAfterSetup(function() use ($location, $description){
            register_nav_menu($location, $description);
        });
        return $this;
    }

    public function removeNavMenu($location){
        $this->actionAfterSetup(function() use ($location){
            unregister_nav_menu($location);
        });
        return $this;
    }
}