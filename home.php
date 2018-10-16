<?php 
get_header(); 
?>
<div id="main">
<?php if ( have_posts() ) : ?>
			<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
			?>
	<?php endif; ?>

		<?php
		if ( have_posts() ) : ?>
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();
				echo "<article>";
the_date('M. d, Y', '<div class="date">', '</div><!-- /.date -->');

			echo '<h3><a href="' . get_the_permalink() . '">';
the_title(); 
echo '</a></h3>';
	the_excerpt('More'); 
	echo "</article>";
			endwhile;
			?>
<div class="as_posts_nav">
<?php next_posts_link( '<- Older posts', $the_query->max_num_pages ); ?><?php previous_posts_link( 'Newer posts ->' ); ?>
</div><!--  /.as_posts_nav -->
<?php 
	

		endif; ?>

		</div><!-- #main -->
<aside class="sidebar">
	<ul class="nobullets">
	<?php dynamic_sidebar('blog_sidebar'); ?>
	</ul>
</aside><!-- .sidebar -->
<?php 
get_footer(); 
?>