<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package artists-theme
 */

?>
<?php
$phone = get_theme_mod('at_phone', 'default_value');
$phoneclean = preg_replace('/[^0-9,.]/', '', $phone);
$address = get_theme_mod('at_address', 'default_value');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header id="site-header">
	<div class="navicon">
		<div class="bar top"></div><!--  /.bar -->
		<div class="bar middle"></div><!--  /.bar -->
		<div class="bar bottom"></div><!--  /.bar -->
  </div><!-- .navicon -->
	<h1 class="site_title"><a href="<?php bloginfo('url'); ?>">
	 	<?php
	 	$custom_logo_id = get_theme_mod( 'custom_logo' );
	 	if($custom_logo_id) {
$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
echo '<img src="' . $image[0] . '" class="no_sw">';
}
else {
	bloginfo('name'); 

}
	 	?>
	 </a></h1>
	 	 <?php
	 if ( (get_theme_mod('header_text') !== 0) && (get_bloginfo('description') !== '') ) {
  echo '<h2 class=="site-description">' . get_bloginfo('description') . '</h2>';
}
?>
</header>
<?php 
	if ( has_nav_menu( 'primary' ) ) {
	wp_nav_menu(array('theme_location'=> 'primary', 'container'=>'nav', 'menu_class'=>'primary')); 
}
?>