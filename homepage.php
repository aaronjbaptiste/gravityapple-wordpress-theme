<?php
/**
 * Template Name: Homepage Template
 *
 */
get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( gravityapple_has_featured_content( ) ) : ?>
		    <div class="featured-content">
		        <?php get_template_part( 'template-parts/content', "featured" ); ?>
		    </div>
		<?php endif; ?>

		<?php 
			$args = array( 'post_type' => 'portfolio', 'posts_per_page' => 10, 'post__not_in' => Featured_Content::get_featured_post_ids ());
			$the_query = new WP_Query( $args ); 
		?>

		<div id="freewall" class="free-wall">

		<?php if ( $the_query->have_posts() ) : ?>
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<div class="portfolio-entry brick" style='width:350px;'>
						<?php get_the_category_custompost($post->ID, 'portfolio_category'); ?>
						<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
							<?php if ( has_post_thumbnail() ) : ?>

								<div class="portfolio-entry-media">
									
									<?php
									the_post_thumbnail( 'ga-portfolio-entry', array(
										'class'	=> 'portfolio-entry-img',
									) ); ?>

								</div><!-- .portfolio-entry-media -->
							<?php endif; ?>
							<div class="cover">
								<div class="overlay"></div>
								<div class="inner-entry">
									<h2><?php the_title(); ?></h2>
								</div>
							</div>
						</a>
					</div>
				<?php wp_reset_postdata(); ?>
			<?php endwhile; ?>
		<?php else:  ?>
			<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif; ?>

		</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
