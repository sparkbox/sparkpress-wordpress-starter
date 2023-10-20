<?php
/**
 * Enqueue Styles
 *
 * @package SparkPress
 */

/**
 * Enqueue styles.
 */
function sparkpress_theme_styles() {
	wp_enqueue_style( 'base-styles', get_template_directory_uri() . '/css/base.css', array(), _S_VERSION );
}
add_action( 'wp_enqueue_scripts', 'sparkpress_theme_styles' );
