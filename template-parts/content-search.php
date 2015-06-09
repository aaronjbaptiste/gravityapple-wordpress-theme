<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package GravityApple
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php gravityapple_posted_on(); ?>
			<?php gravityapple_entry_footer(); ?>
		</div><!-- .entry-meta -->
		<?php the_post_thumbnail(); ?>
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php
		/* translators: %s: Name of current post */
		the_content( "READ MORE" );
	?>

	<footer class="entry-footer">
		
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
<div class="rule"></div>
