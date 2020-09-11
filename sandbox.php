<?php
/**
* Template Name: Sandbox
*
*/


while ( have_posts() ) :
    the_post();

    the_content();


    // If comments are open or we have at least one comment, load up the comment template.
    if ( comments_open() || get_comments_number() ) :
        comments_template();
    endif;

endwhile; // End of the loop.

$terms = get_terms( array(
    'taxonomy' => 'types',
    'hide_empty' => true,
) );
error_log(print_r($terms,1));

$args = array(
    'post_type' => 'project',
    'numberposts'      => 10,
);
$latest_projects = get_posts( $args );

//error_log(print_r($latest_posts,1));
foreach ($latest_projects as $key => $project) {
    $ID = $project->ID;
    $terms = get_the_terms( $ID, 'types' );
    error_log(print_r($terms,1));
    error_log('----------------');
}
