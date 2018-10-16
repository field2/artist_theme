<?php 
get_header(); 
?>
<div id="main">
	<?php the_archive_title("<h2>Archives from ","</h2>"); ?>
<?php 
	if ( have_posts() ) : 
	while ( have_posts() ) : 
	the_post(); 
?> 
<article>
<?php 
	the_title('<h3>','</h3>'); 
	the_content(); 
?>
</article>
<?php 
	endwhile; 
	else : 
?>
	<p>Nothing to see here, folks.</p>
<?php 
	endif; 
?>
</div>
<aside class="sidebar">
	<ul class="nobullets">
	<?php dynamic_sidebar('blog_sidebar'); ?>
	</ul>
</aside><!-- .sidebar -->

<?php 
get_footer(); 
?>