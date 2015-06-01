<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package GravityApple
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( gravityapple_has_featured_content( ) ) : ?>
		    <div class="featured-content">
		        <?php get_template_part( 'template-parts/content', "featured" ); ?>
		    </div>
		<?php endif; ?>

		<?php wp_nav_menu( array( 'theme_location' => 'cat-menu' ) ); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
