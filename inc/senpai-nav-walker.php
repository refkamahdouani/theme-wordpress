<?php
/**
 * https://www.ibenic.com/how-to-create-wordpress-custom-menu-walker-nav-menu-class/
 * https://code.tutsplus.com/tutorials/understanding-the-walker-class--wp-25401
 * https://awhitepixel.com/blog/wordpress-menu-walkers-tutorial/
 * 
 */



//prevent direct access
if ( ! defined( 'ABSPATH' ) ) exit;

// Check if Class Exists.
if ( ! class_exists( 'Crazy_Senpai_Navwalker' ) ) :
	/**
	 * Crazy_Senpai_Navwalker class.
	 */
	class Crazy_Senpai_Navwalker extends Walker_Nav_Menu {

		public $i = 1;

		function start_el(&$output, $item, $depth=0, $args=array(), $id = 0) {
			
			//error_log(print_r($item->classes,1));
			

			$object = $item->object;
			$type = $item->type;
			$title = $item->title;
			$description = $item->description;
			$permalink = $item->url;
			$isparent = $item->menu_item_parent === '0';


			if (in_array('current-menu-item', $item->classes) ){
				$classes[] = 'active ';
			  }
			//error_log($isparent);
			if ($args->walker->has_children) {
				$output .= "<li class='has-submenu " .  implode(" ", $item->classes) . "'>";
			}else{
				$output .= "<li class='" .  implode(" ", $item->classes) . "'>";
			}
			$output .= '<a class="animsition-link" href="' . $permalink . '">';

			if( $isparent ){
				$output .= '0'. $this->i . '. ' .  $title;
				$this->i = $this->i+1;
			}else{
				$output .=$title;
			}
			

			$output .= '</a>';


		}

		function end_el(&$output, $item, $depth=0, $args=array()) {
			$output .= "</li>";
		}


		function start_lvl(&$output, $depth=0, $args=array()) {
			$output .= "<ul>";
		}
	 

		function end_lvl(&$output, $depth=0, $args=array()) {
			$output .= "</ul>";
		}

	}

endif;