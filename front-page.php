<?php get_header(); ?>


<div class="content">
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
<div class="main">
<?php 	if ( have_posts() ) : 	while ( have_posts() ) : 	the_post(); ?> 
<?php 	the_title('<h2>','</h2>'); 	the_content(); ?>
<?php 	endwhile; 	else : ?>
	<p>Nothing to see here, folks.</p>
<?php 	endif; ?>
</div><!--  /.main -->
</div><!-- /.content -->

<?php get_footer(); ?>