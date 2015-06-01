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
            <?php the_post_thumbnail(); ?>
        </div><!-- .slide -->
    <?php endforeach; ?>
</div><!-- .slider -->
<?php wp_reset_postdata(); ?>
