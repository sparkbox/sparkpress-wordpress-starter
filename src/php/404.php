<?php
/**
 * The template for displaying 404 pages (not found)
 */

// https://timber.github.io/docs/reference/timber/#context
$context = Timber\Timber::context();
$timber_post = new Timber\Post();
Timber\Timber::render( '404.twig', $context );
