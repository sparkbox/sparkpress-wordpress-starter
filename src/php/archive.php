<?php
/**
 * The template for displaying archive pages
 *
 * To handle some archive pages differently, create templates with names matching WordPress template hierarchy.
 *
 * Author pages: author.php, author-$id.php, author-$nicename.php
 * Category pages: category.php, category-$id.php, category-$slug.php
 * Custom post type archive pages: archive-$posttype.php
 * Taxonomy pages: taxonomy.php, taxonomy-$taxonomy.php, taxonomy-$taxonomy-$term.php
 * Date archive pages: date.php
 * Tag pages: tag.php, tag-$id.php, tag-$slug.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

$templates = array( 'archive.twig', 'index.twig' );

$context = Timber\Timber::context();

$context['title'] = 'Archive';
if ( is_day() ) {
	$context['title'] = 'Archive: ' . get_the_date( 'D M Y' );
} elseif ( is_month() ) {
	$context['title'] = 'Archive: ' . get_the_date( 'M Y' );
} elseif ( is_year() ) {
	$context['title'] = 'Archive: ' . get_the_date( 'Y' );
} elseif ( is_tag() ) {
	$context['title'] = single_tag_title( '', false );
} elseif ( is_category() ) {
	$context['title'] = single_cat_title( '', false );
	array_unshift( $templates, 'archive-' . get_queried_object()->slug . '.twig' );
} elseif ( is_post_type_archive() ) {
	$context['title'] = post_type_archive_title( '', false );
	array_unshift( $templates, 'archive-' . get_post_type() . '.twig' );
}

$context['posts'] = new Timber\PostQuery();
Timber\Timber::render( $templates, $context );
