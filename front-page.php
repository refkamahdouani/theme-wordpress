<?php get_header(); ?>

			<!-- ************************ -->
			<!--   PAGE TITLE             -->
			<!-- ************************ -->

			<?php 
$image = get_field('bg_image');

if( !empty( $image ) ): ?>

			<div class="title-home jarallax" style="background-image: url(<?php echo esc_url($image['url']); ?>);">
			
<?php endif; ?>
				<div class="overlay"></div>
				<!-- End overlay -->

				<div class="container">
					<div class="text-center">

						<h1 class="typed" data-sr>&nbsp;</h1>

						<em data-sr>Pellentesque vitae feugiat nisi, et pharetra eros. Cras vehicula dignissim augue<br>vitae efficitur erat volutpat. Nulla facilisi tempus mattis.</em>

						<div class="buttons mt40 mb150">

							<a href=" work.html" class="btn btn-white animsition-link" data-sr>
								<span>view our works</span>
							</a>

							<a href="contact.html" class="btn btn-white animsition-link" data-sr>
								<span>contact us</span>
							</a>

                            <a href="contact.html" class="btn btn-white animsition-link" data-sr>
								<span>contact us</span>
							</a>

						</div>

					</div>
				</div>
				<!-- End container -->

				<div class="container">
					<div class="text-center">
						<div class="goto" data-sr>

							<div class="border-top"></div>

							<a href=" work.html" class="animsition-link">all</a>
							<a href=" work.html" class="animsition-link">web design</a>
							<a href=" work.html" class="animsition-link">development</a>
							<a href=" work.html" class="animsition-link">graphic design</a>
							<a href=" work.html" class="animsition-link">branding</a>
							<a href=" work.html" class="animsition-link">photography</a>

						</div>
						<!-- End goto -->
					</div>
				</div>
				<!-- End container -->
			</div>

			<main>
				<div>front page</div>
			</main>
<?php get_footer(); ?>