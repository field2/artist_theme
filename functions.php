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
		add_image_size('banner', 1300, 500, true);
		add_image_size('page_bg', 1200, 1200, true);
		add_image_size('gallery_small', 200, 200, true);
		add_image_size('gallery_large', 400, 400, true);
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

	 wp_enqueue_script( 'slides', get_template_directory_uri() . '/js/jquery.cycle.all.js',  array( 'jquery' ),'1.0.0'  );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script('site', get_template_directory_uri() . '/js/site.js', array('jquery-ui-core', 'jquery'), null, true);

}
add_action('wp_enqueue_scripts', 'artists_theme_scripts');

//remove the emojis
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

// Filter the except length to 20 words.

function wpdocs_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

//Filter the "read more" excerpt string link to the post.

function wpdocs_excerpt_more( $more ) {
    return sprintf( ' &hellip;<a class="read-more" href="%1$s">%2$s</a>',
        get_permalink( get_the_ID() ),
        __( 'Read More', 'textdomain' )
    );
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );

/* artists_theme_ customizer */
function artists_theme_social_array() {
	$social_sites = array(
		'twitter' => 'artists_theme_twitter_profile',
		'facebook' => 'artists_theme_facebook_profile',
		'google-plus' => 'artists_theme_googleplus_profile',
		'pinterest' => 'artists_theme_pinterest_profile',
		'linkedin' => 'artists_theme_linkedin_profile',
		'youtube' => 'artists_theme_youtube_profile',
		'vimeo' => 'artists_theme_vimeo_profile',
		'tumblr' => 'artists_theme_tumblr_profile',
		'instagram' => 'artists_theme_instagram_profile',
	);
	return apply_filters('artists_theme_social_array_filter', $social_sites);
}

function artists_theme_theme_customizer($wp_customize) {
	$wp_customize->add_section('artists_theme_branding_section', array(
		'title' => __('Site branding', 'artists_theme_'),
		'priority' => 30,
		'description' => 'Enter your branding info',
	));

	$wp_customize->add_setting('artists_theme_address');
	$wp_customize->add_setting('artists_theme_logo');
	$wp_customize->add_setting('artists_theme_phone');

	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'artists_theme_phone_num', array(
		'label' => __('Phone', 'artists_theme_'),
		'section' => 'artists_theme_branding_section',
		'settings' => 'artists_theme_phone',
	)));

	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'artists_theme_address', array(
		'label' => __('Address', 'artists_theme_'),
		'type' => 'textarea',
		'section' => 'artists_theme_branding_section',
		'settings' => 'artists_theme_address',
	)));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'artists_theme_logo', array(
		'label' => __('Logo', 'artists_theme_'),
		'section' => 'artists_theme_branding_section',
		'settings' => 'artists_theme_logo',
	)));
	

	$social_sites = array(
		'twitter' => 'artists_theme_twitter_profile',
		'facebook' => 'artists_theme_facebook_profile',
		'google-plus' => 'artists_theme_googleplus_profile',
		'pinterest' => 'artists_theme_pinterest_profile',
		'linkedin' => 'artists_theme_linkedin_profile',
		'youtube' => 'artists_theme_youtube_profile',
		'vimeo' => 'artists_theme_vimeo_profile',
		'tumblr' => 'artists_theme_tumblr_profile',
		'instagram' => 'artists_theme_instagram_profile',
	);



	// set a priority used to order the social sites
	$priority = 5;
	$wp_customize->add_section('artists_theme_social_media_icons', array(
		'title' => __('Social Media Icons', 'artists_theme_'),
		'priority' => 25,
		'description' => __('Add the URL for each of your social profiles.', 'artists_theme_'),
	));

	// create a setting and control for each social site
	foreach ($social_sites as $social_site => $value) {
		$label = ucfirst($social_site);
		if ($social_site == 'facebook') {
			$label = 'Facebook';
		} elseif ($social_site == 'google-plus') {
			$label = 'Google+';
		} elseif ($social_site == 'instagram') {
			$label = 'Instagram';
		} elseif ($social_site == 'linkedin') {
			$label = 'LinkedIn';
		} elseif ($social_site == 'pinterest') {
			$label = 'Pinterest';
		} elseif ($social_site == 'twitter') {
			$label = 'Twitter';
		} elseif ($social_site == 'youtube') {
			$label = 'Youtube';
		} elseif ($social_site == 'vimeo') {
			$label = 'Vimeo';
		}
		// setting
		$wp_customize->add_setting($social_site, array(
			'sanitize_callback' => 'esc_url_raw',
		));
		// control
		$wp_customize->add_control($social_site, array(
			'type' => 'url',
			'label' => $label,
			'section' => 'artists_theme_social_media_icons',
			'priority' => $priority,
		));
		// increment the priority for next site
		$priority = $priority + 5;
	}

}

add_action('customize_register', 'artists_theme_theme_customizer');

// display social media icons function
function my_social_icons_output() {

	$social_sites = artists_theme_social_array();

	foreach ($social_sites as $social_site => $profile) {

		if (strlen(get_theme_mod($social_site)) > 0) {
			$active_sites[$social_site] = $social_site;
		}
	}

	if (!empty($active_sites)) {

		echo '<ul>';
		foreach ($active_sites as $key => $active_site) {
			$class = 'fa fa-' . $active_site;?>
      <li>
        <a class="<?php echo esc_attr($active_site); ?>" target="_blank" href="<?php echo esc_url(get_theme_mod($key)); ?>">
          <i class="<?php echo esc_attr($class); ?>" title="<?php echo esc_attr($active_site); ?>"></i>
        </a>
      </li>
    <?php }
		echo "</ul>";
	}
}

// Slides Custom Post Type
function create_slides_posttype() {
register_post_type('slide',
		array(
			'labels' => array(
				'name' => __('Slides'),
				'singular_name' => __('slide'),
			),
			'public' => true,
			'menu_icon' => 'dashicons-format-gallery',
			'supports' => array('title', 'thumbnail')
		));
};

add_action('init', 'create_slides_posttype');


// Required Plugins, from https://unionping.com/2016/12/06/wordpress-theme-and-required-plugins/
add_action('admin_notices', 'theme_plugin_dependencies');
function theme_plugin_dependencies($checkonly = null) {
	$theme = wp_get_theme();
	$author = ($theme && $theme->exists() && $theme['author']) ? $theme['author'] : 'Ben Dunkle';
	$format = '<div class="notice notice-error is-dismissible"><p>Recommend plugin: %s: %s</p></div>';

	$plugins = array(
		'post-types-order/post-types-order.php' => array(
			'name' => '<a href="https://wordpress.org/plugins/post-types-order/" target="_blank">Post Types Order</a>',
			'slug' => 'post-types-order'
		),
		'imsanity/imsanity.php' => array(
			'name' => '<a href="https://wordpress.org/plugins/imsanity/" target="_blank">Imsanity</a>',
			'slug' => 'imsanity'
		),
		'responsive-lightbox/responsive-lightbox.php' => array(
			'name' => '<a href="https://wordpress.org/plugins/responsive-lightbox/" target="_blank">Responsive Lightbox</a>',
			'slug' => 'responsive-lightbox'
		),
		'contact-form-7/wp-contact-form-7.php' => array(
			'name' => '<a href="https://wordpress.org/plugins/contact-form-7/" target="_blank">Contact Form 7</a>',
			'slug' => 'contact-form-7'
		),	
		'really-simple-captcha/really-simple-captcha.php' => array(
			'name' => '<a href="https://wordpress.org/plugins/really-simple-captcha/" target="_blank">Really Simple Captcha</a>',
			'slug' => 'really-simple-captcha'
		),		
		'very-simple-event-list/vsel.php' => array(
			'name' => '<a href="https://wordpress.org/plugins/very-simple-event-list/" target="_blank">Very Simple Event List</a>',
			'slug' => 'very-simple-event-list'
		),
				'shrinkwrap-images/shrinkwrap_images.php' => array(
			'name' => '<a href="https://wordpress.org/plugins/shrinkwrap-images/" target="_blank">Shrinkwrap Images</a>',
			'slug' => 'shrinkwrap-images'
		)
	);


	$out = '';
	foreach ($plugins as $plugin => $nfo) {
		if (is_wp_error(validate_plugin($plugin))) {
			if (!$nfo['slug']) {
				$out .= sprintf($format, $nfo['name'], "Please contact $author for installation instructions.");
			} else {
				$link = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=' . $nfo['slug']), 'install-plugin_' . $nfo['slug']);
				$out .= sprintf($format, $nfo['name'], "Please <a href='$link'>install</a> this Plugin.");
			}
		} elseif (is_plugin_inactive($plugin)) {
			$link = wp_nonce_url('plugins.php?action=activate&amp;plugin=' . urlencode($plugin), 'activate-plugin_' . $plugin);
			$out .= sprintf($format, $nfo['name'], "Please <a href='$link'>activate</a> this Plugin.");
		}
	}
	if ($checkonly) return $out != '';
	echo $out;
}


// Enable SVG because it should
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

add_theme_support( 'custom-logo', array(
	'height'      => 100,
	'width'       => 400,
	'flex-height' => true,
	'flex-width'  => true,
	'header-text' => array( 'site-title', 'site-description' ),
) );

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