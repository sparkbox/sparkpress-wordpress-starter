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
			'name'          => 'Primary Sidebar',
			'id'            => 'primary-sidebar',
			'description'   => 'Widget for the sidebar area.',
			'before_widget' => '<div>',
			'after_widget'  => '</div>',
		)
	);

	register_sidebar(
		array(
			'name'          => 'Footer',
			'id'            => 'footer-area',
			'description'   => 'Widget for the footer area.',
			'before_widget' => '<div>',
			'after_widget'  => '</div>',
		)
	);
}
add_action( 'widgets_init', 'sparkpress_theme_widgets_init' );

/**
 * Adds sidebar and footer widgets to the Timber context.
 *
 * @param array $context The Timber context array.
 * @return array The updated Timber context array with sidebar and footer widgets.
 */
function sparkpress_add_widgets_to_context( $context ) {
	$context['sidebar_widget'] = Timber\Timber::get_widgets( 'primary-sidebar' );
	$context['footer_widget'] = Timber\Timber::get_widgets( 'footer-area' );
	return $context;
}
add_filter( 'timber/context', 'sparkpress_add_widgets_to_context' );
