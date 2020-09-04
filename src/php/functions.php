<?php
/**
 * Websites functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 */

/**
 * Twig / Timber templating.
 */
$timber = new Timber\Timber();

/**
 * Add Code Helpers
 */
// We want generic helpers first, in case other helpers rely on them.
require get_template_directory() . '/inc/helpers/generic.php';
foreach ( glob( get_template_directory() . '/inc/helpers/*.php' ) as $filename ) {
	if ( strpos( $filename, '/inc/helpers/generic.php' ) ) {
		continue;
	}
	require_once $filename;
}

/**
 * Setup Theme
 */
require get_template_directory() . '/inc/theme-setup.php';

/**
 * Setup Queries
 */
require get_template_directory() . '/inc/setup-queries.php';

/**
 * Theme widgets
 */
require get_template_directory() . '/inc/theme-widgets.php';

/**
 * Shortcodes for WordPress Editor.
 */
foreach ( glob( get_template_directory() . '/inc/shortcodes/*.php' ) as $filename ) {
	require_once $filename;
}

/**
 * Custom Post Type functions
 */
foreach ( glob( get_template_directory() . '/inc/custom-post-types/*.php' ) as $filename ) {
	require_once $filename;
}

/**
 * Custom Taxonomies
 */
foreach ( glob( get_template_directory() . '/inc/taxonomies/*.php' ) as $filename ) {
	require_once $filename;
}

/**
 * Metaboxes
 */
foreach ( glob( get_template_directory() . '/inc/metaboxes/*.php' ) as $filename ) {
	require_once $filename;
}

/**
 * Metaboxes
 */
foreach ( glob( get_template_directory() . '/inc/metaboxes/*.php' ) as $filename ) {
	require_once $filename;
}

/**
 * Enqueue scripts and styles.
 */
require get_template_directory() . '/inc/theme-styles.php';
require get_template_directory() . '/inc/theme-scripts.php';

/**
 * Custom Nav Walker
 */
require get_template_directory() . '/inc/class-sparkpress-walker.php';

/**
 * Add global context for Twig View Files.
 *
 * @param array $context - This is what is passed into our template files and views.
 * @return array
 */
function add_to_context( $context ) {
	$context['menu'] = new \Timber\Menu( 'primary-menu' );
	$context['footer_sidebar'] = Timber\Timber::get_widgets( 'footer-area' );
    return $context;
}
add_filter( 'timber/context', 'add_to_context' );
