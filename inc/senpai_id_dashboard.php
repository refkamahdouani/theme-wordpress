<?php


function senpai_add_column( $columns ){
	$columns['senpai_post_id_clmn'] = 'ID'; // $columns['Column ID'] = 'Column Title';
	return $columns;
}
add_filter('manage_posts_columns', 'senpai_add_column', 5);
add_filter('manage_pages_columns', 'senpai_add_column', 5); // for Pages
 
 
/**
 * Fills the column content
 *
 * @param string $column ID of the column
 * @param integer $id Post ID
 */
function senpai_column_content( $column, $id ){
	if( $column === 'senpai_post_id_clmn')
		echo $id;
}
add_action('manage_posts_custom_column', 'senpai_column_content', 5, 2);
add_action('manage_pages_custom_column', 'senpai_column_content', 5, 2); // for Pages
