<?php
/**
 * Websites functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 */

/**
 * Twig / Timber templating.
 */
use Twig\Extra\String\StringExtension;
use Twig\Extra\Html\HtmlExtension;
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
 * Custom Meta Boxes
 */
foreach ( glob( get_template_directory() . '/inc/meta-boxes/*.php' ) as $filename ) {
	require_once $filename;
}

/**
 * Enqueue scripts and styles.
 */
require get_template_directory() . '/inc/theme-styles.php';
require get_template_directory() . '/inc/theme-scripts.php';

/**
 * Add global context for Twig View Files.
 *
 * @param array $context - This is what is passed into our template files and views.
 * @return array
 */
function add_to_context( $context ) {
	$context['menu'] = new \Timber\Menu( 'primary' );
	return $context;
}
add_filter( 'timber/context', 'add_to_context' );

/**
 * Adds Twig extensions to the Twig environment to enhance functionality:
 * Adds StringExtension (string-extra).
 * Adds HtmlExtension (html-extra).
 *
 * @param \Twig\Environment $twig - The Twig environment to which extensions are added.
 * @return \Twig\Environment The Twig environment with added extensions.
 */
function add_to_twig( $twig ) {
	$twig->addExtension( new StringExtension() );
	$twig->addExtension( new HtmlExtension() );
    return $twig;
}

add_filter( 'timber/twig', 'add_to_twig' );

/**
 * Render page content with password protection.
 *
 * @param object       $post - The current post.
 * @param string|array $templates - The template(s) to render.
 * @param object       $context - The Timber context used to render.
 */
function render_with_password_protection( $post, $templates, $context ) {
	if ( post_password_required( $post->ID ) ) {
		Timber::render( 'single-password.twig', $context );
	} else {
		Timber::render( $templates, $context );
	}
}

/**
 * Filter password protected posts out of listing page queries.
 *
 * @param object $query - The incoming query.
 * @return object
 */
function filter_password_protected_posts( $query ) {
	if ( ! $query->is_admin && ! $query->is_single ) {
		$query->set( 'has_password', false );
	}

	return $query;
}
add_filter( 'pre_get_posts', 'filter_password_protected_posts' );

/**
 * Normalize queries for paginated archive pages to support custom permalink structures.
 *
 * @param array $query_string - The incoming query string to be normalized.
 */
function normalize_pagination_query_strings( $query_string ) {
	if ( isset( $query_string['name'] ) && 'page' === $query_string['name'] && isset( $query_string['page'] ) ) {
		unset( $query_string['name'] );
		$query_string['paged'] = $query_string['page'];
	}

	return $query_string;
}
add_filter( 'request', 'normalize_pagination_query_strings' );
