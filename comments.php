<?php
if (post_password_required()){return;}?>

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
		<div class="comment-wrap pt100">
		<div class="container">
		<h3 class="comment-title">Comments:</h3>
		<div class="comment-list">
			<?php $senpai_comment_count = get_comments_number();?>
        <?php 
        require_once('inc/senpai-comment-walker.php');

        wp_list_comments( array(
            'style'         => '',
            'max_depth'     => 4,
            'short_ping'    => true,
            'avatar_size'   => '50',
            'walker'        => new Senpai_Walker_Comment(),
        ) );
        ?>

		<?php

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ){
			?>
			
			<div class="container">
				<div class="text-center mt80">
					<h6 class="no-comments"><?php esc_html_e( 'Comments are closed.', 'senpai' ); ?></h6>
				</div>
			</div>
			<?php
		}else{
			?>
					<div class="container">
						<div class="text-center mt80">
							<a href="#post-comment" class="btn">
								<span>leave a Comment</span>
							</a>
						</div>
					</div>
					<!-- End container -->
			<?php
		}

	endif; // Check for have_comments().

	//comment_form();
	//https://rudrastyh.com/wordpress/ajax-comments.html
	?>

</div><!-- End comment-list -->
</div><!-- End container -->
</div><!-- End comment-wrap -->
