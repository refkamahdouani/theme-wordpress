<?php


function senpai_blog_dynamic_render_callback( $block_attributes, $content ){

	$title = $block_attributes['title'];
	$desc = $block_attributes['description'];
	$blog_link = get_post_type_archive_link( 'post' );

    $recent_posts = wp_get_recent_posts( array(
        'numberposts' => 4,
        'post_status' => 'publish',
    ) );

	$output = '';

	$output .= "<section class='pt150 pb150'>
    <div class='container'>

        <div class='section-title'>
            <h2 data-sr>$title</h2>

            <div class='row'>
                <div class='col-md-8 col-md-offset-2'>
                    <em data-sr='wait .2s'>$desc</em>
                </div>
            </div>

        </div>
    </div>

<!-- End container -->

<div class='container'>
	<div class='row'> ";


	foreach ($recent_posts as $key => $post) {
	$post_id = $post['ID'];
	//$permalink = get_post_permalink($post_id);
	$view_count = 0;
	$title = get_the_title( $post_id );
	$excerpt = get_the_excerpt( $post_id );
	$thumbnail = get_the_post_thumbnail_url( $post_id,'senpai_700X700');
	
	$permalink = get_permalink($post_id);
	$comments_count = get_comments_number($post_id);
	$post_date = get_the_date( "Y-m-d H:i:s",$post_id);
	$dateobj = DateTime::createFromFormat("Y-m-d H:i:s", $post_date);

	$formattedDate = date_format($dateobj, 'd.m.Y');


	$output .= "<div class='col-md-12'>
	<div class='row'>

		<div class='blog-item large clearfix' data-sr>

			<div class='col-md-8'>
				<div class='thumb'>
					<a href='$permalink' class='animsition-link'>
						<img src='$thumbnail' alt='blog'>
					</a>
				</div>
				<!-- End thumb -->
			</div>
			<div class='col-md-4'>
				<div class='post-content'>
					<div>
						<span class='date'>
						$formattedDate
						</span>
					</div>
					<h6>
						<a href='$permalink' class='animsition-link'>$title</a>
					</h6>
					<p>$excerpt</p>
					<div class='blog-meta'>
						<a href='#'>
							<i class='fa fa-comment-o'></i>$comments_count</a>
						<a href='#'>
							<i class='fa fa-heart-o'></i>$view_count</a>
					</div>
				</div>
				<!-- End post-content -->

			</div>
		</div>
		<!-- End blog-item -->

	</div>
</div> ";

}


$output .= "</div>

</div>
<!-- End container -->

<div class='container mt70'>
	<div class='text-center'>
		<a href='$blog_link' class='btn animsition-link' data-sr>
			<span>see all posts</span>
		</a>
	</div>
</div>
<!-- End container -->

</section>";



return $output;



}


function create_block_blog_block_init() {
	$dir = dirname( __FILE__ );
	$block_base = get_template_directory_uri() . '/blocks/blog/';

	$script_asset_path = "$dir/build/index.asset.php";
	if ( ! file_exists( $script_asset_path ) ) {
		throw new Error(
			'You need to run `npm start` or `npm run build` for the "create-block/blog" block first.'
		);
	}
	$index_js     = 'build/index.js';
	$script_asset = require( $script_asset_path );
	wp_register_script(
		'create-block-blog-block-editor',
		$block_base .$index_js, 
		$script_asset['dependencies'],
		null
	);
	wp_set_script_translations( 'create-block-blog-block-editor', 'blog' );

	$editor_css = 'build/index.css';
	wp_register_style(
		'create-block-blog-block-editor',
		$block_base .$editor_css,
		array(),
		null
	);

	$style_css = 'build/style-index.css';
	wp_register_style(
		'create-block-blog-block',
		$block_base .$style_css,
		array(),
		null
	);

	register_block_type( 'create-block/blog', array(
		'editor_script' => 'create-block-blog-block-editor',
		'editor_style'  => 'create-block-blog-block-editor',
		'style'         => 'create-block-blog-block',
		'render_callback' => 'senpai_blog_dynamic_render_callback'
	) );
}
add_action( 'init', 'create_block_blog_block_init' );
