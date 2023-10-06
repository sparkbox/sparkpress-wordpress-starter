<?php
/**
 * File for Registering Example Custom Post Type
 */

/**
 * Register Example Custom Post Type
 *
 * @return void
 */
function custom_post_type() {
	$labels = array(
		'name'                  => 'Example Custom Posts',
		'singular_name'         => 'Example Custom Post',
		'all_items'             => 'All Posts',
	);
	$args = array(
		'label'                 => 'Example Custom Posts',
		'description'           => 'An example custom post type.',
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'comments', 'revisions', 'trackbacks', 'author', 'excerpt', 'thumbnail' ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_icon'             => 'dashicons-superhero',
		'show_in_rest'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'example', $args );
}
add_action( 'init', 'custom_post_type', 0 );
