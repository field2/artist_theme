<?php
/**
 * artists_theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package artists_theme
 */

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
		 * If you're building a theme based on artists_theme, use a find and replace
		 * to change 'artists_theme' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'artists_theme', get_template_directory() . '/languages' );

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

	wp_enqueue_style( 'artists_theme-style', get_stylesheet_uri() );

	wp_enqueue_style('icons', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script('site', get_template_directory_uri() . '/js/site.js', array('jquery-ui-core', 'jquery'), null, true);
		 // wp_enqueue_script( 'slides', get_template_directory_uri() . '/js/jquery.cycle.all.js',  array( 'jquery' ),'1.0.0'  );


}

add_action( 'wp_enqueue_scripts', 'artists_theme_scripts' );
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Show or hide site description

function artists_theme_header_style() {
    // If the header text option is untouched, let's bail.
    if ( display_header_text() ) {
        return;
    }

    // If the header text has been hidden.
    ?>
    <style type="text/css" id="twentysixteen-header-css">
        .site-branding {
            margin: 0 auto 0 0;
        }

        .site-branding .site-title,
        .site-description {
            clip: rect(1px, 1px, 1px, 1px);
            position: absolute;
        }
    </style>
    <?php
}
endif; // artists_theme_style
**/

function artists_theme_setup_theme_supported_features() {
    add_theme_support( 'editor-color-palette', array(
        array(
            'name' => __( 'strong magenta', 'themeLangDomain' ),
            'slug' => 'strong-magenta',
            'color' => '#a156b4',
        ),
        array(
            'name' => __( 'light grayish magenta', 'themeLangDomain' ),
            'slug' => 'light-grayish-magenta',
            'color' => '#d0a5db',
        ),
        array(
            'name' => __( 'very light gray', 'themeLangDomain' ),
            'slug' => 'very-light-gray',
            'color' => '#eee',
        ),
        array(
            'name' => __( 'very dark gray', 'themeLangDomain' ),
            'slug' => 'very-dark-gray',
            'color' => '#444',
        ),
    ) );
    // add_theme_support( 'align-wide' );
}
 
add_action( 'after_setup_theme', 'artists_theme_setup_theme_supported_features' );