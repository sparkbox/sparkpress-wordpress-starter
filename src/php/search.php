<?php
/**
 * The template for displaying search results pages
 * This is not used if your template is utilizing twig views!
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 */

$context          = Timber\Timber::context();
$context['title'] = 'Search results for ' . get_search_query();
$context['posts'] = new Timber\PostQuery();

Timber\Timber::render( 'search.twig', $context );
