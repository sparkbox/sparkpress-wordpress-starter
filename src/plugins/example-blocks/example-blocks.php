<?php
/**
 * Plugin Name:       Example Blocks
 * Description:       Collection of example blocks to demonstrate how custom blocks can be used and added.
 * Requires at least: 6.1
 * Requires PHP:      7.0
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
