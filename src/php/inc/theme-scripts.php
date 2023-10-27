<?php
/**
 * Enqueue Scripts
 *
 * @package SparkPress
 */

/**
 * Enqueue scripts and styles.
 */
function sparkpress_theme_scripts() {
	wp_enqueue_script( 'sparkpress-theme-script', get_template_directory_uri() . '/js/scripts.js', array(), _S_VERSION, true );

	// You can also define global variables that get appended to an enqueued script.
	// e.g. wp_localize_script( 'sparkpress-theme-script', 'example', array( '1', '2', '3' ) );
	// would define `example` as a global variable with a value of [1, 2, 3]
}
add_action( 'wp_footer', 'sparkpress_theme_scripts' );
