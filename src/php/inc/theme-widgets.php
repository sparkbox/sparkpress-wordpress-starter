<?php
/**
 * Custom Widgets
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

/**
 * Register widgetized areas.
 */
function sparkpress_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => 'Primary Widget Area',
			'id'            => 'primary-widget-area',
			'description'   => 'Primary sidebar area on the side of the page.',
			'before_widget' => '<div>',
			'after_widget'  => '</div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => 'Footer',
			'id'            => 'footer-area',
			'description'   => 'Sidebar for the footer area.',
			'before_widget' => '<div>',
			'after_widget'  => '</div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'sparkpress_theme_widgets_init' );
