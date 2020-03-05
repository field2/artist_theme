<?php
/**
 * artists-theme Theme Customizer
 *
 * @package artists-theme
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function artists_theme_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'artists_theme_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'artists_theme_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'artists_theme_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function artists_theme_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function artists_theme_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function artists_theme_customize_preview_js() {
	wp_enqueue_script( 'artists-theme-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'artists_theme_customize_preview_js' );


/* add social media management to customizer
/* artists_theme customizer */
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
	$wp_customize->add_section('artists_theme_contact_info', array(
		'title' => __('Contact info', 'artists-theme'),
		'priority' => 30,
		'description' => 'Enter your contact info',
	));

		$wp_customize->add_section('artists_theme_google_fonts', array(
		'title' => __('Google Fonts', 'artists-theme'),
		'priority' => 30,
		'description' => 'Using a font stack from Google Fonts? Paste your code here.',
	));



	$wp_customize->add_setting('artists_theme_google_fonts', array('type' => 'theme_mod',));
	$wp_customize->add_setting('artists_theme_email');

	$wp_customize->add_setting('artists_theme_phone');
	$wp_customize->add_setting('artists_theme_address');
	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'artists_theme_phone_num', array(
		'label' => __('Phone', 'artists-theme'),
		'section' => 'artists_theme_contact_info',
						'type' => 'tel',
		'settings' => 'artists_theme_phone',
	)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'artists_theme_email', array(
		'label' => __('Email', 'artists-theme'),
				'type' => 'email',
		'section' => 'artists_theme_contact_info',
		'settings' => 'artists_theme_email',
	)));


	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'artists_theme_address', array(
		'label' => __('Address', 'artists-theme'),
		'type' => 'textarea',
		'section' => 'artists_theme_contact_info',
		'settings' => 'artists_theme_address',
	)));
	
		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'artists_theme_phone_num', array(
		'label' => __('Google Fonts link code', 'artists-theme'),
		'section' => 'artists_theme_google_fonts',
						'type' => 'text',
		'settings' => 'artists_theme_google_fonts',
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
	$wp_customize->add_section('artists_theme_social_media_links', array(
		'title' => __('Social Media Links', 'artists-theme'),
		'priority' => 25,
		'description' => __('Add the URL for each of your social profiles.', 'artists-theme'),
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
			'section' => 'artists_theme_social_media_links',
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

function artists_theme_google_fonts_output() {
  echo get_theme_mod( 'artists_theme_google_fonts');
}
// add_action( 'wp_enqueue_style', 'artists_theme_google_fonts_output');