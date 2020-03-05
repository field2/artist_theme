<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package artists-theme
 */

// if ( ! is_active_sidebar( 'sidebar-1' ) ) {
// 	echo "sdsa";
// 	return;
// }
?>

<aside id="secondary" class="widget-area">
<?php 
	if(is_home()) {
		dynamic_sidebar( 'blog_sidebar' );
	}
	else {
				dynamic_sidebar( 'sidebar-1' ); 
	}

?>
</aside><!-- #secondary -->
