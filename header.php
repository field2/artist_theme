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
<header><div class="hamburger hamburger--3dx">
	<div class="hamburger-box">
	  <div class="hamburger-inner"></div>
	</div>
  </div>
	<h1><?php 
	bloginfo('name'); 
	 ?></h1>
</header>
<?php 
	wp_nav_menu(array('theme_location'=> 'primary', 'container'=>'nav')); 
?>

<ul id="slideshow">



<?php
$slides = new WP_Query('post_type=slide'); 
while ($slides->have_posts()) : $slides->the_post(); ?>
<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $slides->ID ), 'slide' ); ?>
	<li style="background-image: url('<?php echo $image[0]; ?>')"></li>
<?php endwhile; ?>
</ul>
<div id="controls">
<div id="prev"><i class="fa fa-caret-left"></i><i class="fa fa-caret-left"></i></div><!-- #prev  -->
&nbsp;&nbsp;
<div id="next"><i class="fa fa-caret-right"></i><i class="fa fa-caret-right"></i></div><!-- #next  -->

</div><!-- #controls -->
</div><!--  /.wrapper -->