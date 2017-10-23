<!-- the blog page -->
<?php 
get_header(); 
?>
<?php 
	if ( have_posts() ) : 
	while ( have_posts() ) : 
	the_post(); 
?> 
<?php 
	the_title('<h2>','</h2>'); 
	the_date(); 
	the_excerpt();
?>
<a href="<?php echo get_permalink(); ?>">
<?php 
	endwhile; 
	else : 
?>
<?php 
	endif; 
?>
<?php 
get_footer(); 
?>