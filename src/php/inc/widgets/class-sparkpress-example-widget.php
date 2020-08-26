<?php
/**
 * Custom Widget: Example Custom Widget
 */

/**
 * Title Widget
 */
class Sparkpress_Example_Widget extends WP_Widget {
	/**
	 * Registers basic widget information
	 */
	public function __construct() {
		$options     = array( 'description' => 'Just an example' );
		$widget_id   = 'sparkpress_custom_widget';
		$widget_name = 'Footer Title';
		parent::__construct( $widget_id, $widget_name, $options );
	}

	/**
	 * Widget Front End.
	 *
	 * @param array  $args - Widget Arguments.
	 * @param object $instance - Object instance.
	 * @return void
	 */
	public function widget( $args, $instance ) {
		get_custom_template(
			'template-parts/custom-widget.php',
			array(
				'title_text' => $instance['title'],
				'title_type' => $instance['type'],
			)
		);
	}

	/**
	 * Widget Back End.
	 *
	 * @param object $instance - Object instance.
	 * @return void
	 */
	public function form( $instance ) {
		$title_text = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$title_name = $this->get_field_name( 'title' );
		$title_id   = $this->get_field_id( 'title' );
		$type_text  = ! empty( $instance['type'] ) ? $instance['type'] : 'uppercase';
		$type_name  = $this->get_field_name( 'type' );
		$type_id    = $this->get_field_id( 'type' );

		get_custom_template(
			'template-parts/admin-custom-widget.php',
			array(
				'title_text' => $title_text,
				'title_name' => $title_name,
				'title_id'   => $title_id,
				'type_text'  => $type_text,
				'type_name'  => $type_name,
				'type_id'    => $type_id,
			)
		);
	}

	/**
	 * Update Widget.
	 *
	 * @param object $new_instance - Updated Version.
	 * @param object $old_instance - Previous Version.
	 * @return object
	 */
	public function update( $new_instance, $old_instance ) {
		$instance          = $old_instance;
		$instance['title'] = wp_strip_all_tags( $new_instance['title'] );
		$instance['type']  = $new_instance['type'];
		return $instance;
	}

}
