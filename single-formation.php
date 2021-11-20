<?php
    get_header();
?>

<main id="main-content" class="post">
    <?php
        if(have_posts()){
            while(have_posts()){
                the_post();
                ?>

		<section class="module-hero" style="background-image: url('<?php the_post_thumbnail_url('2048x2048') ?>');">
			<div class="container">
				<h1><?php the_title() ?></h1>
			</div>
		</section>
		<section class="module-desc">
			<div class="container container-narrow">
				<p><?php the_field('texte_explicative') ?></p>
			</div>
		</section>

        <?php
            }            
        }
    ?>
	</main>

<?php 
    get_footer();
?>