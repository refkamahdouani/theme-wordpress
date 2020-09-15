<?php

//prevent direct access
if ( ! defined( 'ABSPATH' ) ) exit;

function senpai_load_more_scripts() {
    
global $template;
if(basename($template) != 'archive-project.php')return;

    global $wp_query; 
    
	// register our main script but do not enqueue it yet
	wp_register_script( 'senpai-project-ajax', get_stylesheet_directory_uri() . '/assets/senpai/ajax-projects.js', array('jq-js') );
 
	// now the most interesting part
	// we have to pass parameters to myloadmore.js script but we can get the parameters values only in PHP
	// you can define variables directly in your HTML but I decided that the most proper way is wp_localize_script()
	wp_localize_script( 'senpai-project-ajax', 'senpai_loadmore_params', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
		'posts' => json_encode( $wp_query->query_vars ), // everything about your loop is here
		'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
		'max_page' => $wp_query->max_num_pages
	) );
 
 	wp_enqueue_script( 'senpai-project-ajax' );
}
 
add_action( 'wp_enqueue_scripts', 'senpai_load_more_scripts' );


function senpai_loadmore_ajax_handler(){
 
	// prepare our arguments for the query
	$args = json_decode( stripslashes( $_POST['query'] ), true );
	$args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
	$args['post_status'] = 'publish';
 
	// it is always better to use WP_Query but not here
	query_posts( $args );
	if( have_posts() ) :
 
		// run the loop
		while( have_posts() ): the_post();
        
        $permalink = get_permalink($post);
        $termSlug = [];
        $terms = get_the_terms($post->ID, 'types');
        foreach ($terms as $term) {
            array_push($termSlug,$term->slug);
        }
        $types = implode ( ' ' , $termSlug);
        $feature_img = get_the_post_thumbnail_url();
        ?>
        <div class="crazy-portfolio-item <?php echo $types; ?>">
            <a href="<?php echo $permalink; ?>" class="animsition-link">
                <div
                    class="image-wrap"
                    style="background-image: url(<?php echo $feature_img; ?>);"></div>
                <div class="figure cross"></div>
                <div class="overlay-color"></div>
            </a>
        </div>
        <?php
		endwhile;
	endif;
	die; // here we exit the script and even no wp_reset_query() required!
}
 
 
 
add_action('wp_ajax_loadmore_project', 'senpai_loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore_project', 'senpai_loadmore_ajax_handler'); // wp_ajax_nopriv_{action}