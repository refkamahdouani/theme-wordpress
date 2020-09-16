<?php get_header(); ?>


			<!-- ************************ -->
			<!--   PAGE TITLE             -->
			<!-- ************************ -->
			<?php
			$featured_image_blog = '';
			$featured_image_blog =  wp_crazy_senpai_get_option( 'default-header-blog', 'senpai_fallback_background','' );
			if($featured_image_blog == ''){
				$featured_image_blog =  wp_crazy_senpai_get_option( 'default-header', 'senpai_fallback_background','https://via.placeholder.com/1800x900' );
			}
			?>
			<div class="page-title jarallax" style="background-image: url(<?php echo $featured_image_blog; ?>);">
				<div class="overlay"></div>
				<!-- End overlay -->
				<div class="container">
					<div class="text-center">

						<h1 class="tlt">
							Our Blog
						</h1>

						<div class="breadcrumbs">
							<ul class="list-none">
								<li>
									<a href="index.html" class="animsition-link">Home</a>
								</li>
								<li>
									Blog
								</li>
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
				<!--   BLOG GRID              -->
				<!-- ************************ -->

				<section class="pt150 pb150">

					<div class="container">
						<div class="row">

							<div id="blog-container-senpai" class="blog-masonry">
								
								<!--THE LOOP HERE-->
								<?php while ( have_posts() ) : the_post(); 
								//error_log(print_r($post,1));
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
													<a href="<?php echo $permalink; ?>#leave-comment-senpai">
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
												<a href="<?php echo $permalink; ?>#leave-comment-senpai">
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
								<?php endwhile; ?>
							</div>
							<!-- End blog-masonry-wrap -->

						</div>
					</div>
					<!-- End container -->
					<?php
							//global $wp_query; // you can remove this line if everything works for you
							
							// don't display the button if there are not enough posts
							if (  $wp_query->max_num_pages > 1 ):?>
					<div class="container">
						<div class="text-center mt80">
							<a  id="load-more-posts" class="btn">
								<span>load more</span>
							</a>
						</div>
					</div>
					<?php endif; ?>
					<!-- End container -->

				</section>

			</main>


<?php get_footer(); ?>