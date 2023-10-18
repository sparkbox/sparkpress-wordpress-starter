<?php
/**
 * The template for displaying comments.
 *
 * Loaded by comments_template().
 *
 * @link https://developer.wordpress.org/reference/functions/comments_template/
 */

// https://timber.github.io/docs/reference/timber/#context
$context          = Timber\Timber::context();

$context['should_show_avatars'] = get_option( 'show_avatars' );

Timber\Timber::render( 'partials/comments.twig', $context );
