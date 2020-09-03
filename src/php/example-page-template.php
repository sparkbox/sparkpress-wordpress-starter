<?php
/**
 * Template Name: Example Page Template
 */

// Example metabox.io fields.
$prefix = 'spark_example_';
$checkbox = rwmb_meta( "{$prefix}checkbox_example" );
$check_val = get_checkbox_value( $checkbox );
$cloneable_text = rwmb_meta( "{$prefix}text_example" );
$image = rwmb_meta( "{$prefix}image_example" );
$wysiwyg = rwmb_meta( "{$prefix}wysiwyg_example" );
$image_url = get_image_url( $image );

// Add metabox.io fields to Timber context.
$context = Timber\Timber::context();
$timber_post = new Timber\Post();
$context['post'] = $timber_post;
$context['wysiwyg'] = $wysiwyg;
$context['texts'] = $cloneable_text;
$context['image'] = $image_url;
$context['checked'] = $check_val;
// Render HTML templates.
Timber\Timber::render( 'pages/example-page.twig', $context );
