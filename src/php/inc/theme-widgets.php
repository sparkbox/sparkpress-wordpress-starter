<?php
/**
 * Custom Widgets
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

/**
 * Register widget area.
 */
function sparkpress_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => 'Footer',
			'id'            => 'footer-area',
			'description'   => 'Sidebar for a the footer area.',
			'before_widget' => '<div>',
			'after_widget'  => '</div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'sparkpress_theme_widgets_init' );
