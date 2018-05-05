<?php
$phone = get_theme_mod('eol_phone', 'default_value');
$phoneclean = preg_replace('/[^0-9,.]/', '', $phone);
$address = get_theme_mod('eol_address', 'default_value');
$logo = esc_url(get_theme_mod('eol_logo'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		<?php 
			wp_title();
		?>
	</title>
	<link href="
		<?php  
			echo get_stylesheet_uri(); 
		?>
		" rel="stylesheet">
	<?php 
		wp_head(); 
	?>
</head>
<body <?php body_class(); ?>>
	<div class="wrapper">
<header>
	<div class="navicon">
		<div class="bar top"></div><!--  /.bar -->
		<div class="bar middle"></div><!--  /.bar -->
		<div class="bar bottom"></div><!--  /.bar -->
  </div><!-- .navicon -->
	<h1 class="site_title"><a href="<?php echo bloginfo('home'); ?>">
	 	<?php
	 	$custom_logo_id = get_theme_mod( 'custom_logo' );
	 	if($custom_logo_id) {
$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
echo '<img src="' . $image[0] . '">';
}
else {
	bloginfo('name'); 

}
	 	?>
	 </a></h1>
</header>
<?php 
	wp_nav_menu(array('theme_location'=> 'primary', 'container'=>'nav')); 
?>
<?php if (is_front_page()) { ?>
<ul id="slideshow">



<?php
$slides = new WP_Query('post_type=slide'); 
while ($slides->have_posts()) : $slides->the_post(); ?>
<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $slides->ID ), 'slide' ); ?>
	<li style="background-image: url('<?php echo $image[0]; ?>')"></li>
<?php endwhile; ?>
</ul>
<div id="controls">
<div id="prev"><div class="arrow-left"></div></div><!-- #prev  -->

<div id="next"><div class="arrow-right"></div></div><!-- #next  -->

</div><!-- #controls -->
<?php 
} 
?>


</div><!--  /.wrapper -->