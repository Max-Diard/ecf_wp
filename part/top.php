<a href="#main-menu" class="screen-reader-text"><?php _e('Aller à la navigation principale')?></a>
<a href="#main-content" class="screen-reader-text"><?php _e('Aller au contenu principal')?></a>
<header class="main-header">
	<div class="container">
		<div class="logo"><a href="<?php bloginfo('url') ?>"><?php the_field('titre_du_site', 'option')?></a></div>
		<nav class="main-nav">
			<button aria-expanded="false" aria-controls="main-menu"><?php _e('Menu')?></button>
			<ul class="menu" id="main-menu" hidden>
			<?php
				$args = array(
					'theme_location' 	=> 'haut',
					'container'      	=> '',
				);
				wp_nav_menu($args);
			?>
			</ul>
		</nav>
	</div>
</header>