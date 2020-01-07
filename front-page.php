<?php get_header(); ?>
<?php 	if ( have_posts() ) : 	while ( have_posts() ) : 	the_post(); ?> 
<?php 	the_content(); ?>
<?php 	endwhile; 	else : ?>
	<p>Nothing to see here, folks.</p>
<?php 	endif; ?>
<?php get_footer(); ?>