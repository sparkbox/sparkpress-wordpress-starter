<?php
/**
 * Setup Theme
 *
 * @package SparkPress
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'sparkpress_theme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function sparkpress_theme_setup() {
		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array( 'primary' => 'Primary' ) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'sparkpress_theme_setup' );

if ( ! function_exists( 'rwmb_meta' ) ) {
	/**
	 * This theme utilizes metabox.io. If the plugin isn't installed, this prevents any Fatal Errors.
	 *
	 * @return void
	 */
	function rwmb_meta() {}
	add_action( 'admin_notices', 'metabox_notice' );
}

/**
 * Alert admin that metabox.io isn't activated.
 *
 * @return void
 */
function metabox_notice() {
	?>
	<div class="error notice">
		<p>SparkPress Theme Requirement: Remember to activate metabox.io</p>
	</div>
	<?php
}

/**
 * Hide the main editor on defined page templates
 *
 * Borrowed from: https://gist.github.com/atomtigerzoo/0dd49ed9ca67ec111465
 *
 * @global string $pagenow
 * @return void
 */
function custom_hide_editor() {
	global $pagenow;
	$hidden_pages = array(
		'example-page.php',
	);

	// Only on editor page.
	if ( ! ( 'post.php' === $pagenow ) ) {
		return;
	}

	$post = get_current_post();
	if ( ! isset( $post ) ) {
		return;
	}

	// Hide the editor on a page with a specific page template.
	$template_filename = get_post_meta( $post->ID, '_wp_page_template', true );

	if ( in_array( $template_filename, $hidden_pages, true ) ) {
		add_filter( 'use_block_editor_for_post', '__return_false' );
		remove_post_type_support( 'page', 'editor' );
	}

}
add_action( 'admin_init', 'custom_hide_editor' );
