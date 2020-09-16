<?php get_header(); ?>
			<!-- ************************ -->
			<!--   PAGE TITLE       -->
			<!-- ************************ -->

			<div class="page-title jarallax" style="background-image: url(https://via.placeholder.com/1900x840);">

				<div class="overlay"></div>
				<!-- End overlay -->
				<div class="container">
					<div class="text-center">

						<h1 class="tlt">
							Single Post
						</h1>

						<div class="breadcrumbs">
							<ul class="list-none">
								<li>
									<a href="index_one.html" class="animsition-link">Home</a>
								</li>
								<li>
									<a href="blog_one.html" class="animsition-link">Blog
									</a>
								</li>
								<li>Single Post</li>
							</ul>
						</div>
						<!-- End breadcrumbs -->

					</div>
				</div>
				<!-- End container -->
			</div>
			<!-- End page-title -->

			<main>

				<!-- ************************ -->
				<!--   SINGLE POST            -->
				<!-- ************************ -->

				<section class="pt150 pb150">
				<?php
				while ( have_posts() ) :
					the_post();
				?>
					<div class="container">
						<div class="row">
							<div class="col-sm-12">

								<div class="post-single">
									<div class="thumb">
										<img src="https://via.placeholder.com/1900x840" alt="blog">
									</div>
									<!-- End thumb -->

									<div class="post-content">

										<h6>
											Cras facilisis leo eget auctor dapibus sapien
										</h6>
										<div class="blog-meta">

											<span class="date">
												06.03.2017
											</span>
										</div>
										<div class="blog-meta">
											<a href="#">
												<i class="fa fa-comment-o"></i><?php echo get_comments_number();?></a>
											<a href="#">
											<?php //https://inspirationalpixels.com/add-likes-to-wordpress-posts/ ?>
												<i class="fa fa-heart-o"></i>8</a>
										</div>
										<div class="clearfix"></div>

										<p>
											Maecenas blandit placerat ligula at ultrices. Proin vel dui pretium, suscipit
											erat ut, auctor risus. Ut quis cursus turpis. Sed malesuada orci est, nec
											interdum sapien euismod nec. Curabitur in tellus fermentum, placerat lacus sed,
											posuere ipsum. Mauris ultrices viverra est a accumsan. Aliquam molestie aliquam
											lectus, auctor faucibus enim feugiat eu. Vestibulum at enim ac mi dignissim
											sagittis ut vel dui. Cum sociis natoque penatibus et magnis dis parturient
											montes, nascetur ridiculus mus. Curabitur purus ipsum, faucibus nec faucibus
											eget, cursus sit amet nibh.

										</p>
										<p>

											Cras faucibus vitae orci quis mollis. Quisque fringilla sapien non fringilla
											auctor. Cras eu lorem ut elit dictum convallis. Nunc in arcu hendrerit,
											tristique felis non, pharetra nibh. Donec at pulvinar massa. Etiam mauris orci,
											mattis a consequat at, volutpat non tortor. Fusce vehicula urna vitae vehicula
											varius. Donec sit amet felis est. Nunc pretium, orci id dapibus accumsan, nibh
											diam pretium sapien, vitae porttitor risus sapien eu eros.
										</p>

										<blockquote>
											Mauris interdum blandit enim et elementum. Suspendisse potenti. Mauris nulla
											ipsum, euismod et lacinia em. Donec lobortis magna sed urna cursus, vitae
											ultrices sapien pellentesque. In posuere, risus sed aliquet varius, tortor
											neque. Praesent et congue erat, a tristique ex. Etiam diam est, imperdiet quis
											faucibus ac, vulputate nec diam.
										</blockquote>

										<p>
											Nullam tristique consectetur orci, ut tempor est vehicula sed. Cras eget metus
											ac massa lacinia molestie nec non eros. Vivamus tellus elit, volutpat id
											scelerisque id, elementum ut felis. Nulla lacinia ante id lectus placerat
											tempus. Morbi consequat nunc tortor, eget bibendum tellus tempor at. Cras vel
											maximus felis. Curabitur lacus purus, pulvinar quis turpis at, vehicula maximus
											nibh. Praesent eu ornare leo.
										</p>

									</div>
									<!-- End post-content -->
								</div>
								<!-- End blog-item -->

							</div>
						</div>
					</div>
					<!-- End container -->




				<!-- ************************ -->
				<!--   COMMENTS               -->
				<!-- ************************ -->

					<?php comments_template(); ?>


				<?php endwhile; // End of the loop.?>


				</section>

				<!-- ************************ -->
				<!--   POST COMMENT POPUP     -->
				<!-- ************************ -->

				<div id="senpai-comment-popup" class="remodal post-comment" data-remodal-id="post-comment">

					<button id="close-comment-modal" data-remodal-action="close" class="remodal-close-popup">
						<i class="fa fa-close"></i>
					</button>
					<div class="text-center">
						<h3 class="comment-title">Leave a Comment</h3>
					</div>
					<form id="comment-form" class="comment-form form-black">
						<?php if(!is_user_logged_in()):?>
						<div class="col-sm-12 mb30">
							<div class="form-control">

								<input type="text" id="author" name="author" placeholder="Your name:">

								<div class="line-input"></div>

							</div>
						</div>
						<!-- End col-sm-12 -->
						<div class="col-sm-12 mb30">
							<div class="form-control">

								<input type="text" name="email" placeholder="Your email:">
								<div class="line-input"></div>
							</div>
						</div>
						<?php endif; ?>
						<!-- End col-sm-12 -->
						<div class="col-sm-12 mb50">
							<div class="form-control">

								<textarea id="comment" name="comment" placeholder="Comment:"></textarea>

							</div>
						</div>
						<!-- End col-sm-12 -->
						<div class="col-sm-12 mb50">
							<div id="respond" class="form-control">

							</div>
						</div>
						<!-- End col-sm-12 -->
						<div class="col-sm-12">
							<div class="text-center">
								<button id="submit" class="btn">
									<span>Submit</span>
								</button>
							</div>
						</div>

					</form>
					<!-- End contact-form -->

				</div>
				<!-- End post-comment-->

			</main>

<?php get_footer(); ?>