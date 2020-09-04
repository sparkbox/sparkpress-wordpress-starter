<?php
/**
 * Button Shortcode(s)
 */

/**
 * Generic Button Shortcode. Outputs a <button> or an <a>.
 *
 * @param {array}  $atts - button attributes (color, text, etc.).
 * @param {string} $content - html that the button is wrapping.
 */
function button_shortcode( $atts, $content = null ) {
	$defaults             = array( 'onclick' => '' );
	$variables            = wp_parse_args( $atts, $defaults );
	$variables['btn_content'] = $content;

	return Timber\Timber::compile( 'shortcodes/button.twig', $variables );
}
add_shortcode( 'button', 'button_shortcode' );
