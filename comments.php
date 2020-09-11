<?php
if (post_password_required()){return;}?>

		<div class="comment-wrap pt100">
		<div class="container">
		<h3 id="comments-title" <?php if(!have_comments()){ echo "style='display:none'";} ?> class="comment-title">Comments:</h3>
		<div class="comment-list">
			<?php $senpai_comment_count = get_comments_number();?>
        <?php 
        require_once('inc/senpai-comment-walker.php');

        wp_list_comments( array(
            'style'         => '',
            'max_depth'     => 15,
            'short_ping'    => false,
            'avatar_size'   => '50',
            'walker'        => new Senpai_Walker_Comment(),
		) );
		
	 // Check for have_comments().
        ?>
		</div><!-- End comment-list -->
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
					</div>
					<div id="no-comments-senpai" class="container" <?php if(have_comments()){ echo "style='display:none'";} ?>>
						<div class="text-center mt80">
							<?php if(!have_comments()): ?>
							<h2>⌨ No Comment Yet ⌨</h2>
							<?php endif; ?>
						</div>
					</div>
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

	

	//comment_form();
	//https://rudrastyh.com/wordpress/ajax-comments.html
	?>


</div><!-- End container -->
</div><!-- End comment-wrap -->
