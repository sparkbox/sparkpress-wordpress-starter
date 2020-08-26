<?php
/**
 * Template Part for pagination.
 */

// CSS Classes.
$prev_classes = ( $current_page > 1 ) ? null : 'cmp-pagination__button--inactive';
$next_classes = ( $current_page < $last_page ) ? null : 'cmp-pagination__button--inactive';

if ( $show ) : ?>
	<div class="cmp-pagination">
		<a
			class="cmp-pagination__button cmp-pagination__button--first <?php echo esc_attr( $prev_classes ); ?>"
			href="<?php echo esc_url( $first_link ); ?>"
			aria-hidden="<?php echo esc_attr( $prev_aria ); ?>"
		>
			<?php get_icon( 'pagination-first', '', true ); ?>
		</a>

		<a
			class="cmp-pagination__button cmp-pagination__button--prev <?php echo esc_attr( $prev_classes ); ?>"
			href="<?php echo esc_url( $prev_link ); ?>"
			aria-hidden="<?php echo esc_attr( $prev_aria ); ?>"
		>
			<?php get_icon( 'pagination-prev', '', true ); ?>
		</a>

		<div class="cmp-pagination__info">
			Page <?php echo esc_html( $current_page ); ?> of 		<?php echo esc_html( $last_page ); ?>
		</div>

		<ol class="cmp-pagination__list">

		<?php
		// Limit display to the 3 before and 3 after the current page.
		foreach ( range( $current_page - $range, $current_page + $range ) as $i ) :
			$is_current   = ( $i === $current_page );
			$is_prev      = ( $i < $current_page );
			$is_next      = ( $i > $current_page );
			$current_link = $is_current ? '' : add_query_arg( 'paged', $i );
			$link_class   = $is_current ? 'current' : '';
			$link_class   = $is_prev ? 'prev' : $link_class;
			$link_class   = $is_next ? 'next' : $link_class;
			?>

			<?php if ( $i > 0 && $i <= $last_page ) : ?>
				<li>
					<a
						class="cmp-pagination__page cmp-pagination__page--<?php echo esc_attr( $link_class ); ?>"
						href="<?php echo esc_url( $current_link ); ?>"
						<?php if ( $is_current ) : ?>
							aria-current="true"
						<?php endif; ?>
						>
						<?php echo esc_attr( $i ); ?>
					</a>
				</li>
			<?php endif; ?>
		<?php endforeach; ?>
		</ol>

		<a
			class="cmp-pagination__button cmp-pagination__button--next <?php echo esc_attr( $next_classes ); ?>"
			href="<?php echo esc_url( $next_link ); ?>"
			aria-hidden="<?php echo esc_attr( $next_aria ); ?>"
		>
			<?php get_icon( 'pagination-next', '', true ); ?>
		</a>

		<a
			class="cmp-pagination__button cmp-pagination__button--last <?php echo esc_attr( $next_classes ); ?>"
			href="<?php echo esc_url( $last_link ); ?>"
			aria-hidden="<?php echo esc_attr( $next_aria ); ?>"
		>
			<?php get_icon( 'pagination-last', '', true ); ?>
		</a>
	</div>
	<?php
endif;
