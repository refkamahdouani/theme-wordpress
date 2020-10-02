<?php


function senpai_count_dynamic_render_callback( $block_attributes, $content ){


	$output = '';

	$output ="<section class='counters pt100 pb100'>

	<div class='container'>
						<div class='row'>

							<div class='counter-item sm-mb40' data-sr>
								<div class='col-md-3 col-sm-6'>
									<div class='item-head'>
										<i class='cr-check'></i>
									</div>
									<h6>1245</h6>
									<p>working hours</p>
								</div>
							</div>
							<!-- End counter-item -->
							<div class='counter-item sm-mb40' data-sr>
								<div class='col-md-3 col-sm-6'>

									<div class='item-head'>
										<i class='cr-send'></i>
									</div>
									<h6>648</h6>
									<p>project completed</p>
								</div>
							</div>
							<!-- End counter-item -->

							<div class='counter-item sm-mb40' data-sr>
								<div class='col-md-3 col-sm-6'>
									<div class='item-head'>
										<i class='cr-cup'></i>
									</div>
									<h6>576</h6>
									<p>cups of tea</p>
								</div>
							</div>
							<!-- End counter-item -->

							<div class='counter-item sm-mb40' data-sr>
								<div class='col-md-3 col-sm-6'>
									<div class='item-head'>
										<i class='cr-heart'></i>
									</div>
									<h6>632</h6>
									<p>happy clients</p>
								</div>
							</div>
							<!-- End counter-item -->
						</div>
					</div>
					<!-- End container -->

				</section>";
	

	return $output;


}

function create_block_count_block_init() {
	$dir = dirname( __FILE__ );
	$block_base = get_template_directory_uri() . '/blocks/count/';

	$script_asset_path = "$dir/build/index.asset.php";
	if ( ! file_exists( $script_asset_path ) ) {
		throw new Error(
			'You need to run `npm start` or `npm run build` for the "create-block/count" block first.'
		);
	}
	$index_js     = 'build/index.js';
	$script_asset = require( $script_asset_path );
	wp_register_script(
		'create-block-count-block-editor',
		$block_base .$index_js, __FILE,
		$script_asset['dependencies'],
		null
	);
	wp_set_script_translations( 'create-block-count-block-editor', 'count' );

	$editor_css = 'build/index.css';
	wp_register_style(
		'create-block-count-block-editor',
		$block_base .$editor_css,
		array(),
		null
	);

	$style_css = 'build/style-index.css';
	wp_register_style(
		'create-block-count-block',
		$block_base .$style_css ,
		array(),
		null
	);

	register_block_type( 'create-block/count', array(
		'editor_script' => 'create-block-count-block-editor',
		'editor_style'  => 'create-block-count-block-editor',
		'style'         => 'create-block-count-block',
		'render_callback' => 'senpai_count_dynamic_render_callback'
	) );
}
add_action( 'init', 'create_block_count_block_init' );
