<?php
/**
 * The template for displaying archive pages
 */

$page_num = get_query_var( 'paged' );
$page_num = empty( $page_num ) ? 1 : $page_num;
$posts_per_page = 12; // 2 cols of 6 @md, 3 cols of 4 @lg, 4 cols of 3 @xl.
$count = $GLOBALS['wp_query']->post_count;

get_header();
?>

	<?php if ( have_posts() ) : ?>

		<header class="page-header">
			<?php
			the_archive_title( '<h1 class="page-title">', '</h1>' );
			the_archive_description( '<div class="archive-description">', '</div>' );
			?>
		</header><!-- .page-header -->

		<?php
		/* Start the Loop */
		while ( have_posts() ) :
			the_post();

			/*
			 * Include the Post-Type-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
			 */
			get_template_part( 'template-parts/content', get_post_type() );

		endwhile;

		// the_posts_navigation(); WordPress default navigation.
		get_pagination( $count, $posts_per_page, $page_num );

	else :

		get_template_part( 'template-parts/content', 'none' );

	endif;
	?>

<?php
get_footer();
