Shortcodes
==========

Creating a re-usable Shortcode
------------------------------
Here is a template to create a shortcode. Shortcodes should be added in `src/php/inc/shortcodes.php`

```PHP
/**
 * Description of what Shortcode outputs.
 *
 * @param {array}  $atts - shortcode attributes.
 * @param {string} $content - If the shortcode wraps content, the is the content.
 */
function example_shortcode( $atts, $content = null ) {
	$defaults = array( 'title'   => '' ); # Define attribute defaults here
	$atts = wp_parse_args( $atts, $defaults );
	# Then return the markup.
	return "<h1>{$title}</h1><p>{$content}</p>";
}
// Fill in the shortcode text for the user, then the shortcode function name.
add_shortcode( 'example', 'example_shortcode' );
```

This would allow for content editors to use this [shortcode][shortcode] with:

`[example title="Example Title"]I'm example text[example]`

<!-- Links: -->
[shortcode]:https://developer.wordpress.org/reference/functions/add_shortcode/
