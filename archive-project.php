<?php get_header(); ?>


			<!-- ************************ -->
			<!--   PAGE TITLE             -->
			<!-- ************************ -->
			<?php
			$featured_image_projects = '';
			$featured_image_projects =  wp_crazy_senpai_get_option( 'header-project', 'senpai_fallback_background','' );
			if($featured_image_projects == ''){
				$featured_image_projects =  wp_crazy_senpai_get_option( 'default-header', 'senpai_fallback_background','https://via.placeholder.com/1800x900' );
			}
			?>
			<div class="page-title jarallax" style="background-image: url(<?php echo $featured_image_projects; ?>);">

				<div class="overlay"></div>
				<!-- End overlay -->
				<div class="container">
					<div class="text-center">

						<h1 class="tlt">
							Our Works
						</h1>

						<div class="breadcrumbs">
							<ul class="list-none">
								<li>
									<a href="<?php echo get_home_url(); ?>" class="animsition-link">Home</a>
								</li>
								<li>Our Works</li>
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
				<!--   PORTFOLIO              -->
				<!-- ************************ -->

				<section class="pt150 pb150">
					<div class="container">
						<div class="row">
							<div class="col-sm-12">
								<div class="filters-wrap mb100">

									<div class="borders"></div>

									<div class="text-center">
										<ul class="list-none filters">
											<li class="active-filter" data-filter="*">
												<span>all</span>
											</li>
											<?php
											$terms = get_terms( array(
												'taxonomy' => 'types',
												'hide_empty' => true,
											) );
											$term_HTML = '';
												foreach ($terms as $key => $term) {
													$term_name = $term->name;	
													$term_slug = $term->slug;
													$term_HTML .= "<li data-filter='.${term_slug}'><span>${term_name}</span></li>";
												}
										    echo $term_HTML;
											?>
										</ul>
										<!-- End filters -->

									</div>

								</div>
								<!-- End filters-wrap -->
							</div>
						</div>
					</div>
					<!-- End container -->

					<div class="container">
						<div class="row">
							<div class="crazy-portfolio-masonry-wrapper" data-col="3">
								<div class="crazy-portfolio-list">
								<?php
									$loop = new WP_Query( array(
										'post_type' => 'project',
										'posts_per_page' => 6
									)
									);
									?>

									<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

									<!-- do stuff -->
									<?php 
									$permalink = get_permalink($post);
									//implode ( string $glue , array $pieces )
									$termSlug = [];
									$terms = get_the_terms($post->ID, 'types');
									foreach ($terms as $term) {
										array_push($termSlug,$term->slug);
									}
									$types = implode ( ' ' , $termSlug);
									//error_log(print_r($types,1));
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
									<!-- End crazy-portfolio-item -->
									<?php endwhile; wp_reset_query(); ?>


								</div>
								<!-- End crazy-portfolio-list -->
							</div>
							<!-- ENd crazy-portfolio-masonry-wrapper -->
							<?php
							global $wp_query; // you can remove this line if everything works for you
							
							// don't display the button if there are not enough posts
							if (  $wp_query->max_num_pages > 1 ):?>
							<div class="mt80 text-center">
								<a href="#" id="load-more-projects" class="load-more-btn btn" data-load="3">
									<span>Load More</span>
								</a>
							</div>
							<?php endif; ?>
						</div>
					</div>
					<!-- End container -->

				</section>

			</main>


<?php get_footer(); ?>