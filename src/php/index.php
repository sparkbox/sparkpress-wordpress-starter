<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the two required files for a theme (the other
 * being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * To handle types of pages differently, create templates with names matching WordPress template hierarchy.
 *
 * Archive Pages: archive.php
 * Single Post Pages: single.php
 * Static Pages: page.php
 * Home Page: home.php
 * 404 Page: 404.php
 * Search Page: search.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

$context          = Timber\Timber::context();
$context['posts'] = new Timber\PostQuery();
$templates        = array( 'index.twig' );
if ( is_home() && ! is_front_page() ) {
	$context['title'] = single_post_title();
} elseif ( ! $context['posts']->found_posts ) {
	$context['title'] = 'Nothing Found';
} else {
	$context['title'] = 'Recent Posts';
}
Timber\Timber::render( $templates, $context );
