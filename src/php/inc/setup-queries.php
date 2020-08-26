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
	$vars[] = 'example_var'; // e.g. allow ?example_var="test" in url.
	return $vars;
}

add_filter( 'query_vars', 'sb_query_vars_filter' );
