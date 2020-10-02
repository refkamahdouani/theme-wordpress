<?php get_header(); ?>

			<!-- ************************ -->
			<!--   PAGE TITLE             -->
			<!-- ************************ -->
    <?php
    $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); 
    ?>
			<div
				class="page-title jarallax"
				style="background-image: url(<?php echo $featured_img_url; ?>);">

				<div class="overlay"></div>
				<!-- End overlay -->
				<div class="container">
					<div class="text-center">

						<h1 class="tlt"><?php echo get_the_title(); ?></h1>

						<div class="breadcrumbs">
							<ul class="list-none">
								<li>
									<a href="<?php echo get_home_url(); ?>" class="animsition-link">Home</a>
								</li>
								<li><?php the_title(); ?></li>
							</ul>
						</div>
						<!-- End breadcrumbs -->

					</div>
				</div>
				<!-- End container -->
			</div>
			<!-- End page-title -->

<main>
<?php while ( have_posts() ) : 
	the_post(); 
	the_content();
	endwhile; ?>
</main>


<?php get_footer(); ?>