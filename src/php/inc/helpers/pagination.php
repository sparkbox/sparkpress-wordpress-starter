<?php
/**
 * PHP Helpers for pagination
 */

/**
 * Retrieve Pagination
 *
 * @param [string|num] $total_count - Total count of posts/cpt.
 * @param [string|num] $per_page_count - Count of posts per page.
 * @param [string|num] $current_page - The current page number we're on (start with 1).
 *
 * @return function
 */
function get_pagination( $total_count, $per_page_count, $current_page ) {
	// Make sure any strings are converted.
	$total_count    = intval( $total_count, 10 );
	$per_page_count = intval( $per_page_count, 10 );
	$current_page   = intval( $current_page, 10 );
	// Do any calculations / creation of links.
	$last_page    = ceil( $total_count / $per_page_count );
	$last_link    = ( $current_page < $last_page )
		? add_query_arg( 'paged', $last_page )
		: null;
	$first_link   = ( $current_page > 1 )
		? add_query_arg( 'paged', 1 )
		: null;
	$next_link    = ( $current_page < $last_page )
		? add_query_arg( 'paged', $current_page + 1 )
		: null;
	$prev_link    = ( $current_page > 1 )
		? add_query_arg( 'paged', $current_page - 1 )
		: null;
	$show_pag     = ( $total_count > $per_page_count );
	$prev_aria    = ( $current_page > 1 ) ? 'false' : 'true';
	$next_aria    = ( $current_page < $last_page ) ? 'false' : 'true';
	$range        = 3;
	$range_top    = $current_page - $range;
	$range_bottom = $current_page + $range;
	// Pass them along to the page template.
	return get_custom_template(
		'template-parts/pagination.php',
		array(
			'show'         => $show_pag,
			'current_page' => $current_page,
			'last_page'    => $last_page,
			'last_link'    => $last_link,
			'first_link'   => $first_link,
			'next_link'    => $next_link,
			'next_aria'    => $next_aria,
			'prev_link'    => $prev_link,
			'prev_aria'    => $prev_aria,
			'range'        => $range,
			'range_top'    => $range_top,
			'range_bottom' => $range_bottom,
		)
	);

}
