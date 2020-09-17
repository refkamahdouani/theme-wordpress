			<!-- ************************ -->
			<!--   FOOTER                 -->
			<!-- ************************ -->

			<footer>
			<?php 
$image = get_field('contact');

if( !empty( $image ) ): ?>
				<div class="pt150 jarallax" style="background-image: url(<?php echo esc_url($image['url']); ?>);">
<?php endif; ?>
				<div class="overlay"></div>
				<div class="container">

					<h2 data-sr>contact us</h2>

					<div class="col-sm-8 col-sm-offset-2 pt80 pb80" data-sr="wait .2s">
						<div class="row">
							<form
								class="contact-form"
								id="contact-form"
								action="send_email.php"
								method="post"
								data-all-fields-required-msg="All fields are required"
								data-ajax-fail-msg="Ajax could not set the request"
								data-success-msg="Email successfully sent.">
								<div class="col-sm-12 mb30">
									<div class="form-control">

										<input
										id="name"
											class="contact-form-name"
											type="text"
											name="name"
											placeholder="Your name:">
										<div class="line-input"></div>

									</div>
								</div>
								<!-- End col-sm-12 -->
								<div class="col-sm-12 mb30">
									<div class="form-control">

										<input 
										id="email"
											class="contact-form-email"
											type="text"
											name="email"
											placeholder="Your email:">
										<div class="line-input"></div>

									</div>
								</div>
								<!-- End col-sm-12 -->
								<div class="col-sm-12 mb50">
									<div class="form-control">

										<textarea class="contact-form-message" id="msg" name="message" placeholder="Message:"></textarea>
										<div class="line-input"></div>

									</div>
								</div>
								<!-- End col-sm-12 -->
								<div class="col-sm-12">
									<div class="text-center">

										<button id="send-msg" class="btn btn-white">
											<span>Submit<i class="fa fa-spin fa-spinner ajax-loader" style="display: none;"></i>
											</span>
										</button>

									</div>
								</div>
								<!-- End col-sm-12 -->
								<div class="col-sm-12">
									<p class="return-msg">&nbsp;</p>
								</div>
								<!-- End col-sm-12 -->
							</form>
							<!-- End contact-form -->
						</div>
					</div>
				</div>
				<!-- End container -->

				<div class="container">
					<div class="footer-inner clearfix">

						<div class="border-top"></div>

						<div class="footer-social mb30">
							<ul class="list-none">
								<li>
									<a href="#" target="_blank">
										<i class="fa fa-facebook fa-fw"></i>
									</a>
								</li>
								<li>
									<a href="#" target="_blank">
										<i class="fa fa-twitter fa-fw"></i>
									</a>
								</li>
								<li>
									<a href="#" target="_blank">
										<i class="fa fa-linkedin fa-fw"></i>
									</a>
								</li>
								<li>
									<a href="#" target="_blank">
										<i class="fa fa-behance fa-fw"></i>
									</a>
								</li>
								<li>
									<a href="#" target="_blank">
										<i class="fa fa-pinterest fa-fw"></i>
									</a>
								</li>
							</ul>
						</div>
						<!-- End footer-social -->
						<div class="footer-copy">
							<p>
							Copyright &copy; <span id="year"></span>. 
								<a href="#">SENPAI CODES</a>
							</p>
						</div>
						<!-- End footer-copy -->
					</div>
				</div>
				<!-- End container -->
		</div>
			</footer>

		</div>
		<!-- End animsition -->

		<!-- ************************ -->
		<!--   SCRIPTS                -->
		<!-- ************************ -->

        <?php wp_footer(); ?>
		<script>
			document.getElementById("year").innerHTML = new Date().getFullYear();
		</script>
	</body>
</html>
