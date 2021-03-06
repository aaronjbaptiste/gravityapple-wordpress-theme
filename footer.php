<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package GravityApple
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<?php printf( esc_html__( 'Theme %1$s by %2$s', 'gravityapple' ), '<a href="https://github.com/aaronjbaptiste/gravityapple-wordpress-theme">gravityapple</a>', '<a href="https://twitter.com/aaronjbaptiste" rel="designer">Aaron John-Baptiste</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
