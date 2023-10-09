<?php
/**
 * The template for displaying all single posts
 *
 * To handle some single post pages differently, create templates with names matching WordPress template hierarchy.
 *
 * Attachments: attachment.php, $mimetype.php, $subtype.php, $mimetype-$subtype.php
 * Custom Posts: single-$posttype.php, single-$posttype-$slug.php, $custom.php
 * Standard Posts: single-post.php, $custom.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 */

// https://timber.github.io/docs/reference/timber/#context
$context           = Timber\Timber::context();
$timber_post       = new Timber\Post();
$context['post']   = $timber_post;
$templates         = array( 'single-' . $timber_post->post_type . '.twig', 'page.twig' );

render_with_password_protection( $timber_post, $templates, $context );
