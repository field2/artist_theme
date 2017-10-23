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
<header>
	<h1><?php 
	bloginfo('name'); 
	 ?></h1>
</header>
<?php 
	wp_nav_menu(array('theme_location'=> 'primary', 'container'=>'nav')); 
?>