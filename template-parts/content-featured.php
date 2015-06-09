<?php
/**
 * @package GravityApple
 */

// Get our Featured Content posts
$slider = gravityapple_get_featured_content();
 
// If we have no posts, our work is done here
if ( empty( $slider ) )
    return;
 
// Let's loop through our posts ?>

<div class="slider">
    <?php foreach ( $slider as $post ) : setup_postdata( $post ); ?>
        <div class="slide">
            <?php get_the_category_custompost($post->ID, 'portfolio_category'); ?>
            <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
            <?php the_post_thumbnail(); ?>
            <div class="featured-title">
                <h1>Latest:</h1>
                <h2><?php the_title(); ?></h2>
            </div>
            </a>
        </div><!-- .slide -->
    <?php endforeach; ?>
</div><!-- .slider -->
<?php wp_reset_postdata(); ?>
