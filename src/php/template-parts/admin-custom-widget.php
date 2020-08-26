<?php
/**
 * WP Admin Section: Custom Widget.
 */

?>
<p>
	<fieldset>
		<label for="<?php echo esc_attr( $title_id ); ?>"><b>Title Text</b></label>
		<input
			class="widefat"
			name="<?php echo esc_attr( $title_name ); ?>"
			id="<?php echo esc_attr( $title_id ); ?>"
			type="text"
			value="<?php echo esc_attr( $title_text ); ?>"
		/>
	</fieldset>
	<br />
	<fieldset>
		<p><b>Title Type</b></p>
		<p>
			<input
				id="<?php echo esc_attr( $type_id ); ?>-uppercase"
				type="radio"
				name="<?php echo esc_attr( $type_name ); ?>"
				<?php checked( $type_text, 'uppercase' ); ?>
				value="uppercase"
			>
			<label for="<?php echo esc_attr( $type_id ); ?>-uppercase">Uppercase</label>
		</p>
		<p>
			<input
				id="<?php echo esc_attr( $type_id ); ?>-bold"
				type="radio"
				name="<?php echo esc_attr( $type_name ); ?>"
				<?php checked( $type_text, 'bold' ); ?>
				value="bold"
			>
			<label for="<?php echo esc_attr( $type_id ); ?>-bold">Bold</label>
		</p>
	</fieldset>
</p>
