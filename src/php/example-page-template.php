<?php
/**
 * Template Name: Example Page Template
 */

$context = Timber\Timber::context();
$timber_post = new Timber\Post();
$context['post'] = $timber_post;

// Render HTML templates.
render_with_password_protection( $timber_post, 'pages/example-page.twig', $context );
