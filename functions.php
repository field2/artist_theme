<?php
// custom image sizes
add_theme_support('post-thumbnails');
add_image_size('banner', 1300, 500, true);
add_image_size('page_bg', 1200, 1200, true);
add_image_size('gallery_small', 200, 200, true);
add_image_size('gallery_large', 400, 400, true);

// menus
register_nav_menus(array('primary' => 'Primary Nav', 'footer' => 'Footer Nav'));

// sidebars
function eol_widgets_init() {
	register_sidebar(array(
		'id' => 'sidebar',
		'name' => 'Sidebar Widgets',
	));
}
add_action('widgets_init', 'eol_widgets_init');


// enqueue styles and scripts
function eol_enqueue() {
	wp_enqueue_style('googlefonts', '//fonts.googleapis.com/css?family=Nunito+Sans:300,300i,700');
	wp_enqueue_style('icons', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
	wp_enqueue_style( 'screen', get_stylesheet_uri() );
	 wp_enqueue_script( 'slides', get_template_directory_uri() . '/js/jquery.cycle.all.js',  array( 'jquery' ),'1.0.0'  );
	wp_enqueue_script('site', get_template_directory_uri() . '/js/site.js', array('jquery-ui-core', 'jquery'), null, true);

}
add_action('wp_enqueue_scripts', 'eol_enqueue');



//remove the emojis
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

/* eol_ customizer */
function eol_social_array() {
	$social_sites = array(
		'twitter' => 'eol_twitter_profile',
		'facebook' => 'eol_facebook_profile',
		'google-plus' => 'eol_googleplus_profile',
		'pinterest' => 'eol_pinterest_profile',
		'linkedin' => 'eol_linkedin_profile',
		'youtube' => 'eol_youtube_profile',
		'vimeo' => 'eol_vimeo_profile',
		'tumblr' => 'eol_tumblr_profile',
		'instagram' => 'eol_instagram_profile',
	);
	return apply_filters('eol_social_array_filter', $social_sites);
}

function eol_theme_customizer($wp_customize) {
	$wp_customize->add_section('eol_branding_section', array(
		'title' => __('Site branding', 'eol_'),
		'priority' => 30,
		'description' => 'Enter your branding info',
	));

	$wp_customize->add_setting('eol_address');
	$wp_customize->add_setting('eol_logo');
	$wp_customize->add_setting('eol_phone');

	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'eol_phone_num', array(
		'label' => __('Phone', 'eol_'),
		'section' => 'eol_branding_section',
		'settings' => 'eol_phone',
	)));

	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'eol_address', array(
		'label' => __('Address', 'eol_'),
		'type' => 'textarea',
		'section' => 'eol_branding_section',
		'settings' => 'eol_address',
	)));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'eol_logo', array(
		'label' => __('Logo', 'eol_'),
		'section' => 'eol_branding_section',
		'settings' => 'eol_logo',
	)));
	

	$social_sites = array(
		'twitter' => 'eol_twitter_profile',
		'facebook' => 'eol_facebook_profile',
		'google-plus' => 'eol_googleplus_profile',
		'pinterest' => 'eol_pinterest_profile',
		'linkedin' => 'eol_linkedin_profile',
		'youtube' => 'eol_youtube_profile',
		'vimeo' => 'eol_vimeo_profile',
		'tumblr' => 'eol_tumblr_profile',
		'instagram' => 'eol_instagram_profile',
	);



	// set a priority used to order the social sites
	$priority = 5;
	$wp_customize->add_section('eol_social_media_icons', array(
		'title' => __('Social Media Icons', 'eol_'),
		'priority' => 25,
		'description' => __('Add the URL for each of your social profiles.', 'eol_'),
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
			'section' => 'eol_social_media_icons',
			'priority' => $priority,
		));
		// increment the priority for next site
		$priority = $priority + 5;
	}

}

add_action('customize_register', 'eol_theme_customizer');

// display social media icons function
function my_social_icons_output() {

	$social_sites = eol_social_array();

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
	$format = '<div class="notice notice-error"><p>Please install required plugin %s: %s</p></div>';

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
