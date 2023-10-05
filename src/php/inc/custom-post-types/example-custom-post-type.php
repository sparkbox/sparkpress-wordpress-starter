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
		'menu_name'             => 'Example Custom Posts',
		'name_admin_bar'        => 'Example Custom Post',
		'archives'              => 'Example Custom Post Archives',
		'attributes'            => 'Example Custom Post Attributes',
		'parent_item_colon'     => 'Parent Post:',
		'all_items'             => 'All Posts',
		'add_new_item'          => 'Add New Post',
		'add_new'               => 'Add New',
		'new_item'              => 'New Post',
		'edit_item'             => 'Edit Post',
		'update_item'           => 'Update Post',
		'view_item'             => 'View Post',
		'view_items'            => 'View Posts',
		'search_items'          => 'Search Post',
		'not_found'             => 'Not found',
		'not_found_in_trash'    => 'Not found in Trash',
		'featured_image'        => 'Featured Image',
		'set_featured_image'    => 'Set featured image',
		'remove_featured_image' => 'Remove featured image',
		'use_featured_image'    => 'Use as featured image',
		'insert_into_item'      => 'Insert into post',
		'uploaded_to_this_item' => 'Uploaded to this post',
		'items_list'            => 'Posts list',
		'items_list_navigation' => 'Posts list navigation',
		'filter_items_list'     => 'Filter posts list',
	);
	$args = array(
		'label'                 => 'Example Custom Posts',
		'description'           => 'An example custom post type.',
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'comments', 'revisions', 'trackbacks', 'author', 'excerpt', 'thumbnail' ),
		'taxonomies'            => array( 'category', 'post_tag', 'example_custom_tax' ),
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
