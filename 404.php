<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body id="top" <?php body_class(); ?>>

<div class="animsition">

<!-- ************************ -->
<!--  GO TO TOP               -->
<!-- ************************ -->

<a href="#top" class="toTop">
    <i class="fa fa-angle-up"></i>
</a>

<!-- ************************ -->
<!--   PAGE BORDER            -->
<!-- ************************ -->

<span class="frame-line animated top-frame"></span>
<span class="frame-line animated right-frame"></span>
<span class="frame-line animated bottom-frame"></span>
<span class="frame-line animated left-frame"></span>

<!-- ************************ -->
<!--   NAVBAR                 -->
<!-- ************************ -->

<div class="crazy-navbar">
    <div class="container">

        <div class="crazy-border"></div>

        <div class="crazy-logo">
            <a href="<?php echo get_home_url(); ?>"><img src="https://via.placeholder.com/180x60" alt="crazy-logo"></a>
        </div>
        <!-- End crazy-logo -->

        <?php
        wp_nav_menu( array(
            'theme_location'    => 'menu-1',
            'depth'             => 2,
            'container'         => 'nav',
            'container_class'   => 'crazy-nav',
            'container_id'      => '',
            'menu_class'        => 'sf-menu',
            'walker'            => new Crazy_Senpai_Navwalker(),
        ) );
        ?>
        <a href="#" class="open-menu">
            <i class="burger-icon">
                <i></i>
            </i>
        </a>
    </div>
    <!-- End container -->
    <div class="container">
            <div class="row">
                <div class="mobile-menu-wrap">
                <?php
                wp_nav_menu( array(
                    'theme_location'    => 'menu-1',
                    'depth'             => 2,
                    'container'         => 'nav',
                    'container_class'   => '',
                    'container_id'      => '',
                    'menu_class'        => 'list-none',
                    'walker'            => new Crazy_Senpai_Navwalker(),
                ) );
                ?>
                </div>
                <!-- End mobile-menu-wrap -->
            </div>
        </div>
        <!-- End container -->
    </div>

    <div class="title-home jarallax" style="background-image: url(https://via.placeholder.com/1860x990);">

<div class="overlay"></div>
<!-- End overlay -->

<div class="container">
    <div class="text-center">

        <h1 class="typed" data-sr>&nbsp;</h1>

        <em data-sr>Page not found.</em>

        <div class="buttons mt40 mb150">
            <a href="<?php echo get_home_url(); ?>" class="btn btn-white animsition-link" data-sr>
                <span>back home</span>
            </a>
        </div>

    </div>
</div>
<!-- End container -->

<!-- End container -->
</div>
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