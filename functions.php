<?php
/**
 * GravityApple functions and definitions
 *
 * @package GravityApple
 */

if ( ! function_exists( 'gravityapple_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function gravityapple_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on GravityApple, use a find and replace
	 * to change 'gravityapple' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'gravityapple', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'gravityapple' ),
		'cat-menu' => esc_html__( 'Cat Menu', 'gravityapple' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'gravityapple_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	add_image_size( 'site-logo', 100, 0 );
    add_theme_support( 'site-logo', array(
        'header-text' => array(
            'site-title',
            'site-description'
        ),
        'size' => 'site-logo',
    ));

    add_theme_support( 'featured-content', array(
        'filter'     => 'gravityapple_featured_content',
        'max_posts'  => 1,
        'post_types' => array( 'post', 'page', "portfolio" ),
    ));

    add_theme_support( 'post-thumbnails' ); 
	
}
endif; // gravityapple_setup
add_action( 'after_setup_theme', 'gravityapple_setup' );

function gravityapple_get_featured_content() {
    return apply_filters( 'gravityapple_featured_content', array() );
}

function gravityapple_has_featured_content() {
    $featured_posts = apply_filters( 'gravityapple_featured_content', array() );
    if ( is_array( $featured_posts ) && 1 <= count( $featured_posts ) )
        return true;
 
    return false;
}

if ( is_home() && gravityapple_has_featured_content() ) {
    wp_enqueue_script( 'gravityapple-slider-script', get_template_directory_uri() . '/js/awesome-slider.js', array( 'jquery' ) );
}

function register() {

    // Define post type labels
    $labels = array(
        'name'                  => __( 'Portfolio', 'ga' ),
        'singular_name'         => __( 'Portfolio Item', 'ga' ),
        'add_new'               => __( 'Add New Item', 'ga' ),
        'add_new_item'          => __( 'Add New Portfolio Item', 'ga' ),
        'edit_item'             => __( 'Edit Portfolio Item', 'ga' ),
        'new_item'              => __( 'Add New Portfolio Item', 'ga' ),
        'view_item'             => __( 'View Item', 'ga' ),
        'search_items'          => __( 'Search Portfolio', 'ga' ),
        'not_found'             => __( 'No portfolio items found', 'ga' ),
        'not_found_in_trash'    => __( 'No portfolio items found in trash', 'ga' )
    );
    
    // Define post type args
    $args = array(
        'labels'            => $labels,
        'public'            => true,
        'supports'          => array( 'title', 'editor', 'thumbnail', 'revisions', 'post-formats' ),
        'capability_type'   => 'post',
        'rewrite'           => array("slug" => "portfolio-item"), // Permalinks format
        'has_archive'       => false,
        'menu_icon'         => 'dashicons-portfolio',
    ); 
    
    // Register the post type
    register_post_type( 'portfolio', $args );

    // Define portfolio category taxonomy labels
    $cat_labels = array(
        'name'                          => __( 'Portfolio Categories', 'ga' ),
        'singular_name'                 => __( 'Portfolio Category', 'ga' ),
        'search_items'                  => __( 'Search Portfolio Categories', 'ga' ),
        'popular_items'                 => __( 'Popular Portfolio Categories', 'ga' ),
        'all_items'                     => __( 'All Portfolio Categories', 'ga' ),
        'parent_item'                   => __( 'Parent Portfolio Category', 'ga' ),
        'parent_item_colon'             => __( 'Parent Portfolio Category:', 'ga' ),
        'edit_item'                     => __( 'Edit Portfolio Category', 'ga' ),
        'update_item'                   => __( 'Update Portfolio Category', 'ga' ),
        'add_new_item'                  => __( 'Add New Portfolio Category', 'ga' ),
        'new_item_name'                 => __( 'New Portfolio Category Name', 'ga' ),
        'separate_items_with_commas'    => __( 'Separate portfolio categories with commas', 'ga' ),
        'add_or_remove_items'           => __( 'Add or remove portfolio categories', 'ga' ),
        'choose_from_most_used'         => __( 'Choose from the most used portfolio categories', 'ga' ),
        'menu_name'                     => __( 'Portfolio Categories', 'ga' ),
    );

    // Define portfolio category taxonomy args
    $cat_args = array(
        'labels'            => $cat_labels,
        'public'            => true,
        'show_in_nav_menus' => true,
        'show_ui'           => true,
        'show_tagcloud'     => true,
        'hierarchical'      => true,
        'rewrite'           => array( 'slug' => 'portfolio-category' ),
        'query_var'         => true
    );
    
    // Register the portfolio_category taxonomy
    register_taxonomy( 'portfolio_category', array( 'portfolio' ), $cat_args );

}
register();

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function gravityapple_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'gravityapple_content_width', 640 );
}
add_action( 'after_setup_theme', 'gravityapple_content_width', 0 );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function gravityapple_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'gravityapple' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'gravityapple_widgets_init' );

function gravityapple_before_post_widget( $content ) {
    if ( is_singular( array( 'portfolio' ) ) && is_active_sidebar( 'portfolio-1' )) {
        dynamic_sidebar('portfolio-1');
    }
    return $content;
}
add_filter( 'the_content', 'gravityapple_before_post_widget' );

/**
 * Enqueue scripts and styles.
 */
function gravityapple_scripts() {
	wp_enqueue_style( 'gravityapple-style', get_stylesheet_uri() );

	wp_enqueue_script( 'gravityapple-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

    wp_deregister_script( 'jquery' );
    $jquery_cdn = '//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js';
    wp_enqueue_script( 'jquery', $jquery_cdn, array(), '20130115' );

    wp_enqueue_script( 'freewall', get_template_directory_uri() . '/js/lib/freewall/freewall.js', array(), '20130115', true );

    wp_enqueue_script( 'app', get_template_directory_uri() . '/js/app.js', array(), '20130115', true );

	wp_enqueue_script( 'gravityapple-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'gravityapple_scripts' );

function get_the_category_custompost( $id = false, $tcat = 'category' ) {
    $categories_list =  get_the_term_list( $id, $tcat );
    printf( '<span class="portfolio-links">' . esc_html__( '%1$s', 'gravityapple' ) . '</span>', $categories_list );

    $tags_list = get_the_tag_list( '', esc_html__( ', ', 'gravityapple' ) );
    if ( $tags_list ) {
        printf( '<span class="tags-links">' . esc_html__( '%1$s', 'gravityapple' ) . '</span>', $tags_list );
    }
}

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';