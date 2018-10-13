<footer>
	<?php
	if ( has_nav_menu( 'footer' ) ) {
	wp_nav_menu(array('theme_location'=> 'footer','container'=>'nav'));

	} 
	?>
	<span class="copyright">Copyright <?php 
	echo date('Y'); 
	?> Ben Dunkle aka EmpireOfLight. Licensed under GPL2.</span>
	<nav class="social_links">
		<?php my_social_icons_output(); ?>
	</nav><!--  /.social_links -->
</footer>
<?php 
wp_footer(); 
?>
</body>
</html>