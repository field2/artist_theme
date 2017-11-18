<?php 
get_header(); 
?>
<div class="content">
<div id="main">
<?php if ( have_posts() ) : ?>
			<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
			?>
	<?php endif; ?>

		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

			
the_title('<h2>','</h2>'); 
the_date();
	the_excerpt(); 
			endwhile;
			?>
<div class="f2_posts_nav">
<?php next_posts_link( '<- Older posts', $the_query->max_num_pages ); ?><?php previous_posts_link( 'Newer posts ->' ); ?>
</div><!--  /.f2_posts_nav -->
<?php 
	

		endif; ?>

		</div><!-- #main -->
<aside class="sidebar">
	<ul class="nobullets">
	<?php dynamic_sidebar('sidebar_right'); ?>
	</ul>
</aside><!-- .sidebar -->


</div><!-- .content -->
<?php 
get_footer(); 
?>