<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package artists_theme
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function artists_theme_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'artists_theme_body_classes' );

// Recommended Plugins
add_action('admin_notices', 'theme_plugin_dependencies');
function theme_plugin_dependencies($checkonly = null) {
	$theme = wp_get_theme();
	$author = ($theme && $theme->exists() && $theme['author']) ? $theme['author'] : 'Ben Dunkle';
	$format = '<div class="notice notice-error is-dismissible"><h3>For optimal performance, this theme recommends the following plugins:</h3><p>%s: %s</p></div>';

	$plugins = array(
		'imsanity/imsanity.php' => array(
			'name' => '<a href="https://wordpress.org/plugins/imsanity/" target="_blank">Imsanity</a>',
			'slug' => 'imsanity'
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


// Enable SVG uploads
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