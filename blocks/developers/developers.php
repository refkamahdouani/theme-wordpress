<?php

function senpai_developers_dynamic_render_callback( $block_attributes, $content ){


	$title = $block_attributes['title'];
	$desc = $block_attributes['description'];
	$args = array(
		'role'    => 'developer',
		'orderby' => 'user_nicename',
		'order'   => 'ASC'
	);
	$users = get_users( $args );

	$data_ready = array();

	foreach ($users as $key => $user) {
		$data = array();
		$ID = $user->ID;
		$display_name = $user->data->display_name;
		$departments = array();

		$terms = get_the_terms( $user,'departments');

		if($terms){
			foreach($terms as $key => $term) {
				array_push($departments, $term->name);
			}
		}
		$socials = get_field('socials',$user);
		$cool_avatar = get_field('cool_avatar',$user);

		$userdata = get_user_meta( $ID );
		//error_log(print_r($userdata,1));

		$data['ID'] = $ID;
		$data['display_name'] = $display_name;
		$data['departments'] = $departments;
		$data['socials'] = $socials;
		$data['avatar_url'] = get_avatar_url($ID);
		$data['description'] = $userdata['description'][0];
		$data['cool_avatar'] = $cool_avatar['sizes']['cool_avatar'];

		array_push($data_ready,$data);
	}
	error_log(print_r($data_ready,1));

$output = '';
$output .="<section class='pt150 pb150'>";
$output .="<div class='container'>";
	$output .="<div class='section-title-sm'>";
		$output .="<h2 data-sr>${title}</h2>";
		$output .="<div class='row'>";
			$output .="<div class='col-md-8 col-md-offset-2'>";
			$output .="<em data-sr='wait .2s'>${desc}</em>";
$output .="</div></div></div></div>";
$output .="<div class='container'>";
	$output .="<div class='row'>";
	foreach ($data_ready as $key => $data) {
	$output .="<div class='col-sm-4'>";
		$output .="<div class='team-item sm-mb40' data-sr>";
			$output .="<div class='team-header'>";

			$avatar = $data['cool_avatar'];
			if($avatar == ''){
				$avatar =  wp_crazy_senpai_get_option( 'user-avatar', 'senpai_fallback_background','https://via.placeholder.com/600x700' );
			}

			$output .="<img src='".$avatar."' alt='image'>";
				$output .="<div class='social-wrap'>";
					$output .="<ul class='list-none'>";
					if($data['socials']){
						foreach ($data['socials'] as $key => $social) {
							$output .="<li><a href='".$social['link']."'><i class='fa fa-fw  ".$social['icon']."'></i></a></li>";
						}
					}
					$output .="</ul>";
				$output .="</div>";
			$output .="</div>";
			$output .="<div class='team-footer'>";
				$deps = '';
				if($data['departments']){
					foreach ($data['departments'] as $key => $dep) {
						$deps .= $dep . ' ';
					}
				}
				$output .="<h6>".$data['display_name']." / ".$deps."</h6>";
				$output .="<p>".$data['description']."</p>";
			$output .="</div>";
		$output .="</div></div>";
	}
$output .="</div></div></section>";

return $output;


}

function create_block_developers_block_init() {
	$dir = dirname( __FILE__ );
	$block_base = get_template_directory_uri() . '/blocks/developers/';


	$script_asset_path = "$dir/build/index.asset.php";
	if ( ! file_exists( $script_asset_path ) ) {
		throw new Error(
			'You need to run `npm start` or `npm run build` for the "create-block/developers" block first.'
		);
	}
	$index_js     = 'build/index.js';
	$script_asset = require( $script_asset_path );
	wp_register_script(
		'create-block-developers-block-editor',
		$block_base . $index_js,
		$script_asset['dependencies'],
		null
	);
	wp_set_script_translations( 'create-block-developers-block-editor', 'developers' );

	$editor_css = 'build/index.css';
	wp_register_style(
		'create-block-developers-block-editor',
		$block_base .  $editor_css,
		array(),
		null
	);

	$style_css = 'build/style-index.css';
	wp_register_style(
		'create-block-developers-block',
		$block_base .  $style_css,
		array(),
		null
	);

	register_block_type( 'create-block/developers', array(
		'editor_script' => 'create-block-developers-block-editor',
		'editor_style'  => 'create-block-developers-block-editor',
		'style'         => 'create-block-developers-block',
		'render_callback' => 'senpai_developers_dynamic_render_callback'
	) );
}
add_action( 'init', 'create_block_developers_block_init' );
