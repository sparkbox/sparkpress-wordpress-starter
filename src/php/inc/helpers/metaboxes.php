<?php
/**
 * Set up page-specific meta box options
 */

/**
 * Determine if a meta box should be shown for a particular page
 *
 * @param {mixed|string|array} $param - the thing to search for.
 * @return {bool}
 *
 * Usage:
 *
 * // Example: Home template
 * if ( should_show_meta_box( 'home-page.php' ) ) {
 *   add_filter( 'rwmb_meta_boxes', 'home_metaboxes' );
 * }
 *
 * // Example: multiple templates
 * if ( should_show_meta_box( array( 'home-page.php', 'example-page.php') ) ) {
 *   add_filter( 'rwmb_meta_boxes', 'my_cool_metaboxes' );
 * }
 */
function should_show_meta_box_for( $param ) {
	if ( is_array( $param ) ) {
		return check_by_template_name_array( $param );
	} elseif ( is_string( $param ) ) {
		return check_by_template_name( $param );
	}
	// Return false for edge-cases.
	return false;
}

/**
 * Check if current page template filename is in template filenames array
 *
 * @param {string[]} $template_filenames - e.g. array( 'template-news.php', 'template-blog.php' ).
 * @return {bool}
 */
function check_by_template_name_array( $template_filenames ) {
	$post = get_current_post();
	if ( ! $post ) {
		return false;
	}
	$post_id = $post->ID;
	return in_array(
		get_page_template_slug( $post_id ),
		$template_filenames,
		true
	);
}

/**
 * Check if current page template filename equals passed in template filename
 *
 * @param {string} $template_filename - e.g. 'template-news.php'.
 * @return {bool}
 */
function check_by_template_name( $template_filename ) {
	$post = get_current_post();
	if ( ! $post ) {
		return false;
	}
	$post_id = $post->ID;
	return get_page_template_slug( $post_id ) === $template_filename;
}

/**
 * Returns true/false as to whether a checkbox was selected.
 *
 * @param string $checkbox - The value from rwmb_meta.
 * @return boolean
 */
function get_checkbox_value( $checkbox ) {
	return ( ! empty( $checkbox ) && '1' === $checkbox );
}
