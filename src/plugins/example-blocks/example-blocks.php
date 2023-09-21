<?php
/**
 * Plugin Name:       Example Blocks
 * Description:       Collection of example blocks to demonstrate how custom blocks can be used and added.
 * Requires at least: 6.3
 * Requires PHP:      7.1
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       example-blocks
 *
 * @package           create-block
 */

/**
 * Registers custom blocks from the blocks directory.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function create_block_example_blocks_block_init() {
    $blocks_directory = plugin_dir_path(__FILE__) . '/blocks/';
    $block_directories = glob($blocks_directory . '*', GLOB_ONLYDIR);

    if ($block_directories && is_array($block_directories)) {
        foreach ($block_directories as $block_directory) {
            register_block_type($block_directory);
        }
    }
}
add_action( 'init', 'create_block_example_blocks_block_init' );

/**
 * Add a custom block category to the WordPress block editor (Gutenberg).
 *
 * This function is hooked to the 'block_categories_all' filter and adds a new
 * block category named 'Example Custom Blocks' with the slug 'example-custom-blocks'
 * to the block editor.
 *
 * @param array   $categories An array of existing block categories.
 * @param WP_Post $post       The current post or page object.
 *
 * @return array Modified array of block categories.
 */
function create_category_example_custom_blocks( $categories, $post ) {

	array_unshift( $categories, array(
		'slug'	=> 'example-custom-blocks',
		'title' => 'Example Custom Blocks'
	) );

	return $categories;
}
add_filter( 'block_categories_all', 'create_category_example_custom_blocks', 10, 2);
