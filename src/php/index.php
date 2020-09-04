<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

$context          = Timber\Timber::context();
$context['posts'] = new Timber\PostQuery();
$context['foo']   = 'bar';
$templates        = array( 'index.twig' );
if ( is_home() && ! is_front_page() ) {
	$context['title'] = single_post_title();
}
Timber\Timber::render( $templates, $context );
