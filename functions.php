<?php
/**
 * artists-theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package artists-theme
 */


if ( ! isset( $content_width ) )
    $content_width = 900;


if ( ! function_exists( 'artists_theme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function artists_theme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on artists-theme, use a find and replace
		 * to change 'artists-theme' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'artists-theme', get_template_directory() . '/languages' );

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
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');
		
		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(array('primary' => 'Primary Nav', 'footer' => 'Footer Nav'));
		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'artists_theme_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );


	}
endif;
add_action( 'after_setup_theme', 'artists_theme_setup' );


// sidebars
function artists_theme_widgets_init() {
	register_sidebar(array(
		'id' => 'sidebar',
		'name' => 'Sidebar Widgets',
	));
	register_sidebar(array(
		'id' => 'blog_sidebar',
		'name' => 'Blog Sidebar',
	));
}
add_action('widgets_init', 'artists_theme_widgets_init');


/**
 * Enqueue scripts and styles.
 */
function artists_theme_scripts() {
if(!empty(artists_theme_google_fonts_output())) {
	wp_enqueue_style( 'artists-theme-fonts', artists_theme_google_fonts_output() );
}
	wp_enqueue_style( 'artists-theme-style', get_stylesheet_uri() );

	wp_enqueue_style('icons', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script('site', get_template_directory_uri() . '/js/site.js', array('jquery-ui-core', 'jquery'), null, true);
		 // wp_enqueue_script( 'slides', get_template_directory_uri() . '/js/jquery.cycle.all.js',  array( 'jquery' ),'1.0.0'  );


}

add_action( 'wp_enqueue_scripts', 'artists_theme_scripts' );
/**


/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
