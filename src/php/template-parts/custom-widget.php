<?php
/**
 * Front End: Custom Example Widget.
 */

?>

<div>
	<?php if ( 'bold' === $title_type ) : ?>
		<p>
			<strong><?php echo wp_kses_post( $title_text ); ?></strong>
		</h3>
	<?php else : ?>
		<p>
			<?php echo wp_kses_post( $title_text ); ?>
		</p>
	<?php endif; ?>
</div>
