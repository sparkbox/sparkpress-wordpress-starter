<?php
/**
 * A custom walker, "bootstrapped" off the WP-Bootstrap Walker.
 *
 * This is kept as a reference and can be used, in lieu of Timber Templating.
 *
 * How To Use:
 *
 * if ( has_nav_menu( 'primary' ) ) :
 * wp_nav_menu(
 *    array(
 *        'container'       => 'nav',
 *        'container_class' => 'cmp-menu__nav',
 *        'container_id'    => '',
 *        'menu'            => 'primary',
 *        'menu_id'         => 'main-nav-menu',
 *        'menu_class'      => 'cmp-menu__list cmp-menu__list--main',
 *        'before'          => '',
 *        'after'           => '',
 *        'link_before'     => '<span class="cmp-menu__link-text">',
 *        'link_after'      => '</span>',
 *        'walker'          => new SparkPress_Walker(),
 *    )
 *  );
 * endif;
 */

/**
 * Class Name: SparkPress_Walker
 * Based off of: https://github.com/wp-bootstrap
 */

/* Check if Class Exists. */
if ( ! class_exists( 'SparkPress_Walker' ) ) {
	/**
	 * SparkPress_Walker class.
	 *
	 * @extends Walker_Nav_Menu
	 */
	class SparkPress_Walker extends Walker_Nav_Menu {
		/**
		 * Keep track of which item we're currently viewing.
		 *
		 * @var current_item
		 */
		private $current_item;

		/**
		 * Start Level.
		 *
		 * @see Walker::start_lvl()
		 * @since 3.0.0
		 *
		 * @access public
		 * @param mixed $output Passed by reference. Used to append additional content.
		 * @param int   $depth (default: 0) Depth of page. Used for padding.
		 * @param mixed $args (default: array()) Arguments.
		 * @return void
		 */
		public function start_lvl( &$output, $depth = 0, $args = array() ) {
			$item       = $this->current_item;
			$list_class = ( 0 === $depth ) ? 'cmp-menu__list cmp-menu__list--sub-menu' : 'cmp-menu__list';

			$output .= "<ul class=\"{$list_class}\" aria-labelledby=\"parent-{$item->ID}\">\n";
		}

		/**
		 * Start El.
		 *
		 * @see Walker::start_el()
		 * @since 3.0.0
		 *
		 * @access public
		 * @param mixed $output Passed by reference. Used to append additional content.
		 * @param mixed $item Menu item data object.
		 * @param int   $depth (default: 0) Depth of menu item. Used for padding.
		 * @param mixed $args (default: array()) Arguments.
		 * @param int   $id (default: 0) Menu item ID.
		 * @return void
		 */
		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			$atts               = array();
			$this->current_item = $item;
			$is_top_level       = ( 0 === $depth );
			$down_icon          = '<span class="cmp-parent-nav">&#9660</span>';

			// The class names.
			$value        = '';
			$class_names  = $value;
			$classes      = empty( $item->classes ) ? array() : (array) $item->classes;
			$class_names  = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
			$class_names .= ' cmp-menu__item';
			// All parent items (allows for nesting in the future).
			if ( $args->has_children ) {
				$class_names .= ' cmp-menu__item--has-children js-subnav';
				$atts['id']   = 'parent-' . $item->ID;
			}
			// Add current class to currently open page.
			if ( in_array( 'current-menu-item', $classes, true ) ) {
				$class_names .= ' cmp-menu__item--current';
			}
			$class_names .= ( $is_top_level ) ? ' cmp-menu__item--top' : ' cmp-menu__item--sub-menu';
			$class_names  = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			// The id.
			$id      = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args );
			$id      = $id ? ' id="' . esc_attr( $id ) . '"' : '';
			$output .= '<li' . $id . $value . $class_names . '>';

			// The title.
			if ( empty( $item->attr_title ) ) {
				$atts['title'] = ! empty( $item->title ) ? wp_strip_all_tags( $item->title ) : '';
			} else {
				$atts['title'] = $item->attr_title;
			}

			// The rest.
			$atts['target'] = ! empty( $item->target ) ? $item->target : '';
			$atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
			$atts['href']   = ! empty( $item->url ) ? $item->url : '';
			$atts['class']  = 'cmp-menu__link';
			$atts           = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );
			$attributes     = '';

			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}
			$item_output  = $args->before;
			$item_output .= '<a' . $attributes . '>';
			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			$item_output .= ( $args->has_children && $is_top_level ) ? $down_icon . '</a>' : '</a>';
			$item_output .= $args->after;
			$output      .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}

		/**
		 * Traverse elements to create list from elements.
		 *
		 * Display one element if the element doesn't have any children otherwise,
		 * display the element and its children. Will only traverse up to the max
		 * depth and no ignore elements under that depth.
		 *
		 * This method shouldn't be called directly, use the walk() method instead.
		 *
		 * @see Walker::start_el()
		 * @since 2.5.0
		 *
		 * @access public
		 * @param mixed $element Data object.
		 * @param mixed $children_elements List of elements to continue traversing.
		 * @param mixed $max_depth Max depth to traverse.
		 * @param mixed $depth Depth of current element.
		 * @param mixed $args Arguments.
		 * @param mixed $output Passed by reference. Used to append additional content.
		 * @return null Null on failure with no changes to parameters.
		 */
		public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
			if ( ! $element ) {
				return; }
			$id_field = $this->db_fields['id'];
			// Display this element.
			if ( is_object( $args[0] ) ) {
				$args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] ); }
			parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		}

		/**
		 * Menu Fallback
		 * =============
		 * If this function is assigned to the wp_nav_menu's fallback_cb variable
		 * and a menu has not been assigned to the theme location in the WordPress
		 * menu manager the function with display nothing to a non-logged in user,
		 * and will add a link to the WordPress menu manager if logged in as an admin.
		 *
		 * @param array $args passed from the wp_nav_menu function.
		 */
		public static function fallback( $args ) {
			if ( current_user_can( 'edit_theme_options' ) ) {

				/* Get Arguments. */
				$container       = $args['container'];
				$container_id    = $args['container_id'];
				$container_class = $args['container_class'];
				$menu_class      = $args['menu_class'];
				$menu_id         = $args['menu_id'];

				if ( $container ) {
					echo '<' . esc_attr( $container );
					if ( $container_id ) {
						echo ' id="' . esc_attr( $container_id ) . '"';
					}
					if ( $container_class ) {
						echo ' class="' . sanitize_html_class( $container_class ) . '"'; }
					echo '>';
				}
				echo '<ul';
				if ( $menu_id ) {
					echo ' id="' . esc_attr( $menu_id ) . '"'; }
				if ( $menu_class ) {
					echo ' class="cmp-menu__list ' . esc_attr( $menu_class ) . '"'; }
				echo '>';
				echo '<li><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '" title="">Add a menu</a></li>';
				echo '</ul>';
				if ( $container ) {
					echo '</' . esc_attr( $container ) . '>'; }
			}
		}
	}
}
