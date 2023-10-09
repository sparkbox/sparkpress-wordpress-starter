<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 *
 * Please note that this is the WordPress construct of pages and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * To handle some pages differently, create templates with names matching WordPress template hierarchy.
 *
 * Custom Page Templates: $custom.php Default
 * Page Templates: page-$id.php page-$slug.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

// https://timber.github.io/docs/reference/timber/#context
$context           = Timber\Timber::context();
$timber_post       = new Timber\Post();
$context['post']   = $timber_post;
$templates         = array( 'page-' . $timber_post->post_name . '.twig', 'page.twig' );

render_with_password_protection( $timber_post, $templates, $context );
