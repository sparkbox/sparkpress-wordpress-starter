<?php
/**
 * Template Name: Example Page Template Without Twig
 *
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/
 */

// Example metabox.io fields.
$prefix = 'spark_example_';
$checkbox = rwmb_meta( "{$prefix}checkbox_example" );
$check_val = get_checkbox_value( $checkbox );
$cloneable_text = rwmb_meta( "{$prefix}text_example" );
$image = rwmb_meta( "{$prefix}image_example" );
$wysiwyg = rwmb_meta( "{$prefix}wysiwyg_example" );
$image_url = get_image_url( $image );

get_header();
?>

<div class="obj-width-limiter util-padding-y-md">
	<h1>I'm a page template.</h1>

	<?php
	if ( ! empty( $wysiwyg ) ) {
		echo '<h3>WYSIWYG Example:</h3>';
		echo wp_kses_post( $wysiwyg );
	}
	if ( ! empty( $cloneable_text ) ) {
		echo '<h3>Cloneable Text Example:</h3>';
		foreach ( $cloneable_text as $text ) {
			echo '<li>';
			echo wp_kses_post( $text );
			echo '</li>';
		}
	}
	if ( ! empty( $image_url ) ) {
		echo '<h3>Image Example:</h3>';
		echo '<img src="';
		echo esc_url( $image_url );
		echo '" alt="Example Image" />';
	}
	echo ( $check_val ) ? '<h3>Checkbox Checked</h3>' : '<h3>Checkbox Not Checked</h3>';

	?>
</div>
<?php
get_sidebar();
get_footer();
