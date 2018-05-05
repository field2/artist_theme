<?php 
get_header(); 
?>


<div class="content two_col">
<div class="main">
	<h1>Search Results</h1>
<?php
global $wp_query;
$total_results = $wp_query->found_posts;
if($total_results!==0) {
	echo "<h2>We found " . $total_results . "result(s).</h2>";

}
else {
	echo "<h2>Sorry, no results were found.</h2>";
}
?>     


<?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>    
		<?php the_title(); ?>
		<?php the_excerpt(); ?>
		<?php wp_link_pages(); ?>
		<?php endwhile; ?>
     <?php endif; ?>





</div>
<aside class="sidebar">

	<ul class="nobullets">
	<?php dynamic_sidebar('blog_sidebar'); ?>
</ul>
</aside>
</div>
<?php 
get_footer(); 
?>


