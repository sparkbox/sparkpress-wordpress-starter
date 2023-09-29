<?php
/**
 * PHP Helpers that are generic, and may be utilized by other helpers
 */

/**
 * Define Globals for within Theme.
 */
function define_theme_globals() {
	// Define your own site-specific environment variables here.
	// phpcs:ignore
	define( 'CUSTOM_ENVIRONMENT_VARIABLE', $_SERVER['CUSTOM_ENVIRONMENT_VARIABLE'] ?? '' );
}
add_filter( 'init', 'define_theme_globals' );

/**
 * Given an array of attributes, return a string of key="value" pairs separated by spaces.
 * Also handles escaping the attributes. Can be helpful when creating a template with optional
 * parameters.
 *
 * Explaining the ('href' === $key) conditional:
 * - It's best practice to escape strings that will be echoed to the page, for security reasons.
 * - In order to correctly escape the $val string, we want to use esc_url or esc_attr respectively.
 *
 * @param array $atts - html attributes.
 * @param array $exclude - attributes to exclude from the output string. Defaults to `[]`.
 * @return string
 */
function get_attribute_string( $atts, $exclude = array() ) {
	$attrs_str = '';

	foreach ( $atts as $key => $val ) {
		$key = trim( $key );
		$val = trim( $val );

		$should_exclude = in_array( $key, $exclude, true ) || empty( $val );
		if ( $should_exclude ) {
			continue;
		}

		if ( 'href' === $key ) {
			$attrs_str .= ' ' . $key . '="' . esc_url( $val ) . '"';
		} else {
			$attrs_str .= ' ' . $key . '="' . esc_attr( $val ) . '"';
		}
	}

	return $attrs_str;
}

/**
 * Get array of file names in a given directory.
 *
 * @param string $path - relative location of directory.
 * @param string $extension - file extension. Defaults to ".php".
 *
 * @return array
 */
function get_filenames_from_dir( $path, $extension = '.php' ) {
	$absolute_path = get_template_directory() . '/' . $path . '/';
	$files         = array();

	foreach ( glob( $absolute_path . '*' . $extension ) as $filename ) {
		$filename = str_replace( $absolute_path, '', $filename );
		array_push( $files, $filename );
	}

	return $files;
}

/**
 * Return whether a link is external link or not.
 *
 * @param string $url - The url / href to check.
 * @return bool
 */
function is_external_link( $url = '' ) {
	$domain = wp_parse_url( get_home_url() );
	$link   = wp_parse_url( $url );

	if ( empty( $link['host'] ) || empty( $domain['host'] ) ) {
		return false;
	}

	return ( $domain['host'] !== $link['host'] );
}

/**
 * Try and get the current post from the GET or POST variable
 * note - this uses super-global form vars but doesn't actually deal with form submission, so usage of these vars is safe.
 *
 * @return {Object | false}
 */
function get_current_post() {
	// Get the Post ID.
	// @codingStandardsIgnoreStart
	if ( array_key_exists( 'post', $_GET ) ) {
		$post_id = wp_unslash( $_GET['post'] );
	} elseif ( array_key_exists( 'post_ID', $_POST ) ) {
		$post_id = wp_unslash( $_POST['post_ID'] );
	} else {
		// If 'post' is not in the $_GET or $_POST array, die.
		return false;
	}
	if ( ! isset( $post_id ) ) {
		return false;
	}
	// Get post from post id.
	$post = get_post( $post_id );
	if ( ! isset( $post ) ) {
		return false;
	}
	return $post;
	// @codingStandardsIgnoreEnd
}

/**
 * Get Image URL from Image ID.
 *
 * @param string $thumb_id - The ID of the image.
 * @param string $size - The size. Either from https://codex.wordpress.org/Post_Thumbnails#Thumbnail_Sizes or a custom size.
 * @return string
 */
function get_image_url( $thumb_id, $size = 'full' ) {
	$thumb_url_array = wp_get_attachment_image_src( $thumb_id, $size, true );
	$thumb_url = $thumb_url_array[0];
	return $thumb_url;
}

/**
 * Get the featured image URL from from within the WordPress loop.
 * https://codex.wordpress.org/The_Loop
 *
 * @param string $size - The size. Either from https://codex.wordpress.org/Post_Thumbnails#Thumbnail_Sizes or a custom size.
 * @return string
 */
function get_featured_image_url( $size = 'full' ) {
	$thumb_id = get_post_thumbnail_id();
	$thumb_url_array = get_image_url( $thumb_id, $size );
	$thumb_url = $thumb_url_array[0];
	return $thumb_url;
}
