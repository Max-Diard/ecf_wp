<?php
    get_header();
?>

<!-- Si la personne ce perd, elle retombera sur la même page que la front page -->

<main id="main-content">
    <!-- 1er section -->
    <section class="home-hero inverted" style="background-image: url('<?php the_post_thumbnail_url('2048x2048') ?>')">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title"><?php the_field('titre_hero') ?></h1>
                <a href="<?php echo get_post_type_archive_link('etudiant') ?>" class="hero-link"><?php the_field('texte_bouton') ?></a>
            </div>
        </div>
    </section>
    <!-- 2eme section -->
    <section class="last-news">
        <div class="container">
            <h2 class="section-title"><?php the_field('titre_actualite') ?></h2>
            <?php 
            
            // Boucle perso 
            // 1- Tableau Argument

            $args = array(
                'post_type'         => 'post',
                'posts_per_page'    =>  3
            );

            // 2- La requete
            $requete = new WP_Query($args);

            // 3- Boucle

            if($requete->have_posts()):
                while($requete->have_posts()):
                    $requete->the_post();
                    ?>

                    <article class="card">
                        <img loading="lazy"  src="<?php the_post_thumbnail_url('img-news') ?>" alt="<?php the_post_thumbnail_caption() ?>" class="card-img" />
                        <div class="card-content">
                            <p class="card-date">
                                <img class='card-date-before' src='<?php
                                $image = get_field('image_date', 'option');
                                echo $image['sizes']['img-date'];?>' alt=''/>
                                    <?php echo get_the_date() ?>
                            </p>
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

                endwhile;
            endif;
            // 4- Réinitialise la boucle par défaut

            wp_reset_postdata();
            ?>

        </div>
    </section>
    <!-- 3eme section -->
    <section class="students inverted">
        <div class="container">
            <h2 class="section-title"><?php the_field('titre_etudiant') ?></h2>
            
        <?php
        // Boucle perso 
        // 1- Tableau Argument

        $args = array(
            'post_type'         => 'etudiant',
            'posts_per_page'    =>  4
        );

        // 2- La requete
        $requete = new WP_Query($args);

        // 3- Boucle

        if($requete->have_posts()):
            while($requete->have_posts()):
                $requete->the_post();
                ?>

            <article class="student">
                <img loading="lazy"  src="<?php the_post_thumbnail_url() ?>" alt="<?php the_post_thumbnail_caption() ?>"  class="student-img">
                <h2 class="student-name"><?php the_title() ?></h2>
                <a href="<?php the_permalink()?>" class="student-link"><?php the_field('titre', 'option');?></a>
            </article>

                <?php

            endwhile;
        endif;

        // 4- Réinitialise la boucle par défaut

        wp_reset_postdata();

        ?>

        </div>
    </section>
    <!-- 4eme section -->
    <section class="modules">
        <div class="container">
            <h2 class="section-title"><?php the_field('titre_formation') ?></h2>
            <?php
            // Boucle perso 
            // 1- Tableau Argument

            $args = array(
                'post_type'         => 'formation',
                'posts_per_page'    =>  2
            );

            // 2- La requete
            $requete = new WP_Query($args);

            // 3- Boucle

            if($requete->have_posts()):
                while($requete->have_posts()):
                    $requete->the_post();
                    ?>

                <article class="card">
                    <img loading="lazy"  src="<?php the_post_thumbnail_url('img-formation') ?>"alt="<?php the_post_thumbnail_caption() ?>" class="card-img">
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

                endwhile;
            endif;

            // 4- Réinitialise la boucle par défaut

            wp_reset_postdata();

            ?>
            
        </div>
    </section>
</main>

<?php 
    get_footer();
?>