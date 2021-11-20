<footer class="main-footer">
	<div class="container">
		<address>
			<?php the_field('texte', 'option') ?>
		</address>
		<nav class="footer-nav">
		<?php
			$args = array(
				'theme_location' 	=> 'bas',
				'container'      	=> '',
				'menu_class'     	=> 'menu',
			);
			wp_nav_menu($args); 
		?>
		</nav>
		<nav class="social-nav">
		<?php
			$args = array(
				'theme_location' 	=> 'bas_social',
				'container'      	=> '',
				'menu_class'     	=> 'menu'
			);
			wp_nav_menu($args); 
		?>
		</nav>
	</div>
</footer>

	<?php 
	wp_footer(); 
	?>

</body>
</html>