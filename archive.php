<?php 
get_header(); 
?>
<div id="main">
<?php 
	if ( have_posts() ) : 
	while ( have_posts() ) : 
	the_post(); 
?> 
<?php 
	the_title('<h2>','</h2>'); 
	the_content(); 
?>
<?php 
	endwhile; 
	else : 
?>
	<p>Nothing to see here, folks.</p>
<?php 
	endif; 
?>
</div>
<div id="sidebar">
	<?php dynamic_sidebar('widgets'); ?>
</div>

<?php 
get_footer(); 
?>