<?php
/**
 * PHP Blog Post Helpers
 */

/**
 * Return dependent categories.
 *
 * @param string $category_id - The ID of the parent Category.
 * @return array
 */
function get_child_categories( $category_id ) {
	return get_categories( array( 'parent' => $category_id ) );
}

/**
 * Return posts for a given category (and child categories).
 *
 * @param string $category_id - The ID of the parent Category.
 * @param int    $num_posts - The number of posts to include.
 * @return array
 */
function get_child_posts( $category_id, $num_posts = 3 ) {
	return get_posts(
		array(
			'numberposts' => $num_posts,
			'category'    => $category_id,
		)
	);
}

/**
 * Return an object with child categories + posts.
 *
 * @param string $category_id - The ID of the parent Category.
 * @param int    $num_posts - The number of posts to include.
 * @return object
 */
function get_parent_category_object( $category_id, $num_posts = 3 ) {
	$category           = new stdClass();
	$category->children = get_child_categories( $category_id );
	$category->posts    = get_child_posts( $category_id, $num_posts );

	return $category;
}

/**
 * Return the excerpt with X max words.
 *
 * @param string $excerpt - from WordPress's get_the_excerpt for example.
 * @param int    $limit - number of words.
 * @return string
 */
function word_count( $excerpt, $limit ) {
	$words = explode( ' ', $excerpt );
	return implode( ' ', array_slice( $words, 0, $limit ) );
}
