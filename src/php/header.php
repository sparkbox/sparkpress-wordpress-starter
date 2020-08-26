<?php
/**
 * Theme Header
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js safe-focus">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="obj-page">
	<div class="obj-width-limiter">
		<a class="cmp-skip-to-content" href="#main">Skip to content</a>
		<a class="cmp-skip-to-content" href="#nav">Skip to navigation</a>
	</div>

	<header class="cmp-header">
		<div id="nav" class="cmp-menu js-menu obj-width-limiter">
			<div class="cmp-menu__container cmp-menu__container--nav">
				<?php
				if ( has_nav_menu( 'primary' ) ) :
					wp_nav_menu(
						array(
							'container'       => 'nav',
							'container_class' => 'cmp-menu__nav',
							'container_id'    => '',
							'menu'            => 'primary',
							'menu_id'         => 'main-nav-menu',
							'menu_class'      => 'cmp-menu__list cmp-menu__list--main',
							'before'          => '',
							'after'           => '',
							'link_before'     => '<span class="cmp-menu__link-text">',
							'link_after'      => '</span>',
							'walker'          => new SparkPress_Walker(),
						)
					);
				endif;
				?>
			</div>
		</div><!-- .cmp-menu -->
	</header><!-- .cmp-header -->

	<main id="main">

