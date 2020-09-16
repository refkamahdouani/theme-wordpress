<?php

//prevent direct access
if ( ! defined( 'ABSPATH' ) ) exit;

function senpai_load_more_scripts_posts() {
    
global $template;
if(basename($template) != 'home.php')return;

    global $wp_query; 
    
	// register our main script but do not enqueue it yet
	wp_register_script( 'senpai-posts-ajax', get_stylesheet_directory_uri() . '/assets/senpai/ajax-blog.js', array('jq-js') );
 
	// now the most interesting part
	// we have to pass parameters to myloadmore.js script but we can get the parameters values only in PHP
	// you can define variables directly in your HTML but I decided that the most proper way is wp_localize_script()
	wp_localize_script( 'senpai-posts-ajax', 'senpai_loadmore_params', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
		'posts' => json_encode( $wp_query->query_vars ), // everything about your loop is here
		'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
		'max_page' => $wp_query->max_num_pages
	) );
 
 	wp_enqueue_script( 'senpai-posts-ajax' );
}
 
add_action( 'wp_enqueue_scripts', 'senpai_load_more_scripts_posts' );


function senpai_loadmore_ajax_handler_posts(){
 
	// prepare our arguments for the query
	$args = json_decode( stripslashes( $_POST['query'] ), true );
	$args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
	$args['post_status'] = 'publish';
 
	// it is always better to use WP_Query but not here
	query_posts( $args );
	if( have_posts() ) :
 
		// run the loop
		while( have_posts() ): the_post();
        
		$detect = basename( get_page_template($post));
		$type = 'Default';
		$permalink = get_permalink($post);
		$title = get_the_title();
		$comments_count = get_comments_number();
		$feature_img = get_the_post_thumbnail_url();

		$post_date = get_the_date( "Y-m-d H:i:s");
		$format = "Y-m-d H:i:s";

		//https://www.php.net/manual/en/datetime.formats.php
		$dateobj = DateTime::createFromFormat($format, $post_date);

		//https://www.php.net/manual/en/datetime.format.php
		$formattedDate = date_format($dateobj, "d.m.Y");
		//error_log(print_r($formattedDate,1));

		if($detect == 'singleVideo.php'){
			$type = 'Video';
		}
		
		if($type == 'Default'):
			if($feature_img):
			// default post with featured img
		?>
			<div class="isotope-item">
				<div class="blog-item">

					<div class="thumb">
						<a href="<?php echo $permalink; ?>" class="animsition-link">
							<img src="<?php echo $feature_img; ?>" alt="blog">
						</a>
					</div>
					<!-- End thumb -->

					<div class="post-content">
						<div>
							<span class="date">
								06.03.2017
							</span>
						</div>
						<h6>
							<a href="<?php echo $permalink; ?>" class="animsition-link"><?php echo $title; ?></a>
						</h6>
						<p>
							Vestibulum euismod sodales. Suspend consequat, quis tincidunt molestie.
						</p>
						<div class="blog-meta">
							<a href="#">
								<i class="fa fa-comment-o"></i><?php echo $comments_count; ?></a>
							<a href="#">
								<i class="fa fa-heart-o"></i>8</a>
						</div>
					</div>
					<!-- End post-content -->
				</div>
				<!-- End blog-item -->
			</div>
			<!-- End isotope-item featured -->
		<?php else://default post with no featured img ?>
			<div class="isotope-item">
			<div class="blog-item full-img clearfix">

				<div class="post-content text-center">
					<div>
						<span class="date">
							06.03.2017
						</span>
					</div>
					<h6>
						<a href="<?php echo $permalink; ?>" class="animsition-link"><?php echo $title; ?></a>
					</h6>

					<div class="blog-meta">
						<a href="#">
							<i class="fa fa-comment-o"></i><?php echo $comments_count; ?></a>
						<a href="#">
							<i class="fa fa-heart-o"></i>8</a>
					</div>

				</div>
				<!-- End post-content -->
			</div>
			<!-- End blog-item -->
		</div>
		<!-- End isotope-item Simple -->
		<?php endif; ?>

		<?php elseif($type == 'Video'): ?>
			<div class="isotope-item">
			<div
				class="blog-item full-img clearfix"
				style="background-image: url(https://via.placeholder.com/600x540);">

				<div class="post-content text-center">

					<h6>
						<a href="<?php echo $permalink; ?>" class="animsition-link"><?php echo $title; ?></a>
					</h6>
					<p>Mauris velit diam, consectetur orci nec, malesuada imperdiet justo.
						Suspendisse laoreet sem auctor congue, sit amet.
					</p>
					<div class="mt50">
						<a href="https://vimeo.com/84015807" class="btn btn-play popup-video" data-sr>
							<span>
								<i class="fa fa-play"></i>
							</span>
						</a>
					</div>
				</div>
				<!-- End post-conten -->
			</div>
			<!-- End blog-item -->
		</div>
		<!-- End isotope-item Video -->
		<?php endif; ?>

        <?php
		endwhile;
	endif;
	die; // here we exit the script and even no wp_reset_query() required!
}
 
 
 
add_action('wp_ajax_loadmore_posts', 'senpai_loadmore_ajax_handler_posts'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore_posts', 'senpai_loadmore_ajax_handler_posts'); // wp_ajax_nopriv_{action}