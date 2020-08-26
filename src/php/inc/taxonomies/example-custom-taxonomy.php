<?php
/**
 * Register Example Taxonomy.
 */

/**
 * Register Example Taxonomy to Example Custom Post Type.
 *
 * @return void
 */
function register_custom_taxonomy() {

	$labels = array(
		'name'          => 'Example Custom Taxonomy',
		'singular_name' => 'Taxonomy',
		'menu_name'     => 'Taxonomy',
	);
	$args   = array(
		'labels'            => $labels,
		'hierarchical'      => false,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => true,
	);
	register_taxonomy( 'example_custom_tax', array( 'example' ), $args );

}
add_action( 'init', 'register_custom_taxonomy', 0 );
