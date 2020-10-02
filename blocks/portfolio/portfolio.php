<?php

error_log(print_r('test',1));

function senpai_portfolio_dynamic_render_callback( $block_attributes, $content ){
$output = '';



return $output;
}
function create_block_portfolio_block_init() {
	$dir = dirname( __FILE__ );
	$block_base = get_template_directory_uri() . '/blocks/portfolio/';

	$script_asset_path = "$dir/build/index.asset.php";
	if ( ! file_exists( $script_asset_path ) ) {
		throw new Error(
			'You need to run `npm start` or `npm run build` for the "wp-crazy-senpai-refka/portfolio" block first.'
		);
	}
	$index_js     = 'build/index.js';
	$script_asset = require( $script_asset_path );
	wp_register_script(
		'wp-crazy-senpai-refka-portfolio-block-editor',
		$block_base .  $index_js, 
		$script_asset['dependencies'],
		null
	);
	wp_set_script_translations( 'wp-crazy-senpai-refka-portfolio-block-editor', 'portfolio' );

	$editor_css = 'build/index.css';
	wp_register_style(
		'wp-crazy-senpai-refka-portfolio-block-editor',
		$block_base .  $editor_css,
		array(),
	    null

	);

	$style_css = 'build/style-index.css';
	wp_register_style(
		'wp-crazy-senpai-refka-portfolio-block',
		$block_base .  $style_css,
		array(),
		null
	);

	register_block_type( 'wp-crazy-senpai-refka/portfolio', array(
		'editor_script' => 'wp-crazy-senpai-refka-portfolio-block-editor',
		'editor_style'  => 'wp-crazy-senpai-refka-portfolio-block-editor',
		'style'         => 'wp-crazy-senpai-refka-portfolio-block',
		'render_callback' => 'senpai_portfolio_dynamic_render_callback'
	) );
}
add_action( 'init', 'create_block_portfolio_block_init' );
