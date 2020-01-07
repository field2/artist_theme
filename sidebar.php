<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package artists_theme
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	echo "sdsa";
	return;
}
?>

<aside id="secondary" class="widget-area">
sss
	<?php 
	if(is_home()) {
		dynamic_sidebar( 'blog_sidebar' );
	}

		dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
