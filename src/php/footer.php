<?php
/**
 * The template for displaying the footer
 *
 * No need to escape, it's the year:
 * phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
 */

$privacy_url = get_privacy_policy_url();
?>
	</main>

	<footer>
		<div class="obj-width-limiter">
			<p>
				&copy; <?php echo gmdate( 'Y' ); ?>
				<span aria-hidden="true">&nbsp;|&nbsp;</span>
				<a href="<?php echo esc_url( $privacy_url ); ?>">
					Privacy Policy
				</a>
			</p>
			<?php dynamic_sidebar( 'footer-area' ); ?>
		</div>
	</footer>
</div> <!-- .obj-page -->
<?php wp_footer(); ?>

</body>
</html>
