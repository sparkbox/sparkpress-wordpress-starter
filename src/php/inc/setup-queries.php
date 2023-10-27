<?php
/**
 * Add / Allow Query Parameters.
 */

/**
 * Add query variables to the list of allowed query-able parameters.
 *
 * @param array $vars - The list of allowed query-able parameters provided by WordPress.
 * @return array
 */
function sb_query_vars_filter( $vars ) {
	// Allow custom query params in URL.
	// e.g. $vars[] = 'example_var'; to allow ?example_var=test in URL.
	return $vars;
}
// Uncomment this line if you've added custom query params.
// add_filter( 'query_vars', 'sb_query_vars_filter' );

/**
 * Alter default query to fetch posts from custom post types on archive pages.
 *
 * @param object $query - The incoming query.
 * @return object
 */
function enable_custom_posts_in_archives( $query ) {
	if ( $query->is_admin() || $query->is_post_type_archive() ) {
		return $query;
	}

	if ( $query->is_archive() || ( $query->is_home() && $query->is_main_query() ) ) {
		$query->set(
			'post_type',
			array(
				'post',
				// Extend which post types will be queried by default on archive pages.
				// e.g. 'recipe', to fetch posts for a custom post type with the slug 'recipe'
			)
		);
	}

	return $query;
}
add_filter( 'pre_get_posts', 'enable_custom_posts_in_archives' );
