<?php get_header(); ?>
<h1>single member</h1>
<?php while ( have_posts() ) : 
	the_post(); 
	the_content();
	endwhile; ?>

<?php get_footer(); ?>