<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 */

$context          = Timber\Timber::context();

$search_term = get_search_query();
$context['title'] = 'Search results for ' . $search_term;
$context['posts'] = new Timber\PostQuery();

Timber\Timber::render( 'search.twig', $context );
