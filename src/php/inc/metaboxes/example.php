<?php
/**
 * Metaboxes for Hero Images.
 */

/**
 * Register metaboxes for the Example Page Template.
 * You can visit https://metabox.io/online-generator/ to view a helpful online generator.
 *
 * @link https://docs.metabox.io/
 *
 * @param {array} $meta_boxes - array of meta boxes.
 * @return {array}
 */
function example_register_meta_boxes( $meta_boxes ) {
	$prefix = 'spark_example_';

	$meta_boxes[] = [
		'title'      => 'Example',
		'id'         => $prefix . 'metaboxes',
		'post_types' => [ 'page' ], // What types of post types e.g. posts, pages, custom_post_type.
		'context'    => 'side', // Where to display on admin page. https://docs.metabox.io/creating-meta-boxes/#contexts .
		'priority'   => 'high',
		'fields'     => [
			[
				'type' => 'checkbox',
				'id'   => $prefix . 'checkbox_example',
				'name' => 'Checkbox',
				'desc' => 'Click Yes or No!',
			],
			[
				'type'        => 'text',
				'id'          => $prefix . 'text_example',
				'name'        => 'Text',
				'desc'        => 'Put Text Here',
				'std'         => 'Default Value',
				'placeholder' => 'Try me out',
				'clone'       => true,
			],
			[
				'type'             => 'image_advanced',
				'id'               => $prefix . 'image_example',
				'name'             => 'Image Advanced',
				'desc'             => 'Upload an Image.',
				'max_file_uploads' => 1,
				'max_status'       => true,
			],
			[
				'type' => 'wysiwyg',
				'id'   => $prefix . 'wysiwyg_example',
				'name' => 'WYSIWYG',
			],
		],
	];

	return $meta_boxes;
}

// Only apply metabox to these templates.
if ( should_show_meta_box_for( 'example-page-template.php' ) ) {
	add_filter( 'rwmb_meta_boxes', 'example_register_meta_boxes' );
}
