<?php
/**
 * Enqueue Scripts
 */

/**
 * Enqueue scripts and styles.
 */
function sparkpress_theme_scripts() {
	$example_data = array( '1', '2', '3' );
	wp_enqueue_script( 'sparkpress-theme-script', get_template_directory_uri() . '/js/scripts.js', array(), _S_VERSION, true );
	// Defines an `example` JavaScript variable, within the sparkpress-theme-script, equal to $example_data.
	wp_localize_script( 'sparkpress-theme-script', 'example', $example_data );
}
add_action( 'wp_footer', 'sparkpress_theme_scripts' );
