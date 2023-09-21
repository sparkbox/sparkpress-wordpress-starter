<?php
/**
 * Template Name: Example Page Template
 */

$context = Timber\Timber::context();
$timber_post = new Timber\Post();
$context['post'] = $timber_post;

// Render HTML templates.
Timber\Timber::render( 'pages/example-page.twig', $context );
