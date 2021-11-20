<?php
    get_header();
?>

<main id="main-content" class="modules">
		<div class="container container-narrow">
			<h1 class="modules-title"><?php the_field('titre_formation', 'option') ?></h1>
            <div class="module-desc">
                <p><?php the_field('explication', 'option') ?></p>
            </div>
        </div>
        <div class="container">
        <?php 
            if (have_posts()){
                while (have_posts()){
                    the_post()
                    ?>
                    <article class="card">
						<img loading="lazy"  src="<?php the_post_thumbnail_url() ?>" alt="<?php the_post_thumbnail_caption() ?>" class="card-img" >
						<div class="card-content">
							<h2 class="card-title"><?php the_title() ?></h2>
							<p class="card-excerpt"><?php the_excerpt() ?></p>
						</div>
						<a href="<?php the_permalink() ?>" class="card-link"><?php the_field('titre', 'option');?>
						<?php
						$image = get_field('image', 'option');
						if( !empty( $image ) ): ?>
							<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
						<?php endif; ?>
						</a>
					</article>
                    <?php
                }
                // Boucle perso 
                // 1- Tableau Argument

                $args = array(
                    'post_type'         => 'formation'
                );

                // 2- La requete
                $requete = new WP_Query($args);
                // 3- Boucle
                ?>

                <nav class="pagination">
                	<?php bittersweet_pagination() ?>
                </nav>

                <?php
                // 4- Réinitialise la boucle par défaut

                wp_reset_postdata();

            }
        ?>

    </div>
</main>

<?php 
    get_footer();
?>