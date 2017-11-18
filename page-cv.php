
<?php 
get_header(); 
?>
<div class="content">


<div class="main">
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
</div><!-- .main -->
<?php if(isset($show_sidebar)) { ?>

<div class="sidebar">
	<?php dynamic_sidebar('widgets'); ?>
</div><!-- .sidebar -->
<?php } ?>
</div><!-- .content -->
<?php 
get_footer(); 
?>