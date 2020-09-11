<?php

//prevent direct access
if ( ! defined( 'ABSPATH' ) ) exit;

//$senpai->addScript( 'ajax_comment', get_stylesheet_directory_uri() . '/ajax-comment.js', array('jq-js') );

add_action( 'wp_enqueue_scripts', 'senpai_ajax_comments_scripts' );
 
function senpai_ajax_comments_scripts() {
    global $post;
	// just register for now, we will enqueue it below
	wp_register_script( 'ajax_comment', get_stylesheet_directory_uri() . '/assets/senpai/ajax-comment.js', array('jq-js') );
 
	// let's pass ajaxurl here, you can do it directly in JavaScript but sometimes it can cause problems, so better is PHP
    
    //https://wordpress.stackexchange.com/questions/211831/get-the-current-post-id-as-a-variable-in-javascript/270143
    wp_localize_script( 'ajax_comment', 'senpai_ajax_comment_params', array(
        'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
        'postID' => $post->ID,
        'nonce' => wp_create_nonce('ajax-nonce')
	) );
 
 	wp_enqueue_script( 'ajax_comment' );
}


add_action( 'wp_ajax_ajaxcomments', 'senpai_submit_ajax_comment' ); // wp_ajax_{action} for registered user
add_action( 'wp_ajax_nopriv_ajaxcomments', 'senpai_submit_ajax_comment' ); // wp_ajax_nopriv_{action} for not registered users
 
function senpai_submit_ajax_comment(){
    // Check for nonce security
    $nonce = $_POST['nonce'];

    if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
        die ( 'error');

    $comment = wp_handle_comment_submission(wp_unslash( $_POST ));
    //$comment = wp_new_comment( array $commentdata, bool $wp_error = false );
    //error_log(print_r($_POST ,1));
    //error_log(print_r(wp_unslash( $_POST ),1));
    //error_log(print_r($comment,1));
	if ( is_wp_error( $comment ) ) {
        
		$error_data = intval( $comment->get_error_data() );
		if ( ! empty( $error_data ) ) {
			wp_die( '<p>' . $comment->get_error_message() . '</p>', __( 'Comment Submission Failure' ), array( 'response' => $error_data, 'back_link' => true ) );
		} else {
			wp_die( 'Unknown error' );
		}
	}
 
	/*
	 * Set Cookies
	 */
    $user = wp_get_current_user();
    //error_log(print_r($user,1));
	do_action('set_comment_cookies', $comment, $user);
 

 
 	/*
 	 * Set the globals, so our comment functions below will work correctly
 	 */
    $GLOBALS['comment'] = $comment;
    
    $comment_content = $comment->comment_content;
    $comment_user =  $comment->user_id;
    $comment_id =$comment->comment_ID;
    $comment_author =$comment->comment_author;
    $comment_post_ID =$comment->comment_post_ID;
    $comment_date = $comment->comment_date;
    $format = "Y-m-d H:i:s";
    $dateobj = DateTime::createFromFormat($format, $comment_date);
    $formattedDate = date_format($dateobj, 'g:i a\, l jS F Y');
    $avatar              = get_avatar_url( $comment, $args['avatar_size'] );
    $reply_comment = '';

    $output = '';
    $comment_classes = 'media';
    $output .= "<div data-sr id='comment-${comment_id}' class='${reply_comment} ${comment_classes}' >";
    $output .= '<div class="pull-left">';
    $output .= "<img class='comment-img' src='${avatar}' alt='avatar'>";
    $output .= '</div>';
    $output .= '<div class="media-body">';
    $output .=            "<h6>${comment_author}";
    $output .=            "<span>${formattedDate}</span>";
    $output .=            '</h6>';
    $output .=            "<p>${comment_content}</p>";
    $output .=            '<div class="comment-meta">';
    $output .= "<a id='replay' href='#post-comment' data='${comment_id}'>Reply</a>";
    $output .= '<a href="#">Share</a>';
    $output .= '</div></div></div>';
 

	echo $output;
 
	die();
 
}