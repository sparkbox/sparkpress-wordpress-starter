<?php
/**
 * PHP Helpers that are specific shortcodes
 */

/**
 * Get template part markup for shortcodes.
 * Benefit is that you can use template parts, and allow for variables.
 *
 * Docs for locate_template: https://developer.wordpress.org/reference/functions/locate_template/
 *
 * @param string $slug - location of template part, e.g. "template-parts/content-none.php".
 * @param array  $variables - Array of variables so that they are within scope of locate_template.
 * @return string
 */
function get_custom_shortcode_template( $slug, $variables = array() ) {
	// Loop over variables so that the template file can use them.
	foreach ( $variables as $key => $val ) {
		$$key = $val;
	}

	ob_start();
	include locate_template( $slug );
	return ob_get_clean();
}

