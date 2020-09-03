<?php
/**
 * The template for displaying an example custom post type.
 */

// https://timber.github.io/docs/reference/timber/#context
$context           = Timber\Timber::context();
$timber_post       = new Timber\Post();
$context['post']   = $timber_post;
Timber\Timber::render( array( 'page-' . $timber_post->post_name . '.twig', 'page.twig' ), $context );
