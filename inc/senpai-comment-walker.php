<?php

//prevent direct access
if ( ! defined( 'ABSPATH' ) ) exit;

class Senpai_Walker_Comment extends Walker_Comment {
 
//https://developer.wordpress.org/reference/classes/walker_comment/
  
//https://developer.wordpress.org/reference/classes/walker_comment/
    protected function html5_comment( $comment, $depth, $args ) { 
                        error_log(print_r($comment,1));
                        $comment_author_link = get_comment_author_link( $comment );
                        $comment_author_url  = get_comment_author_url( $comment );
                        $comment_author      = get_comment_author( $comment );
                        $avatar              = get_avatar_url( $comment, $args['avatar_size'] );
                        $reply_comment = '';

                        if($comment->comment_parent !== '0'){
                            $reply_comment = 'reply-comment';
                        }
                        //https://developer.wordpress.org/reference/functions/get_comment_date/
                        $comment_timestamp = sprintf( __( '%1$s at %2$s', 'custom' ), get_comment_date( "l, F jS, Y", $comment ), get_comment_time() );
        ?>
        <div data-sr id="comment-<?php comment_ID(); ?>" <?php comment_class($reply_comment . ' ' . $this->has_children ? 'parent media' : 'media', $comment ); ?>>
        <div class="pull-left">
										<img class="comment-img" src="<?php echo $avatar; ?>" alt="avatar">
									</div>

									<div class="media-body">
										<h6><?php echo $comment_author;?>
                                        <span><?php echo $comment_timestamp; ?></span>
										</h6>

										<p><?php comment_text(); ?></p>
										<div class="comment-meta">
                                            <?php if ( comments_open() ){?><a id="replay" href="#post-comment" data="<?php comment_ID(); ?>">Reply</a><?php }?>
											<a href="#">Share</a>
										</div>
									</div>
									
        </div>
        <?php
    }
}
