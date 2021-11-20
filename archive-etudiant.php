<?php
    get_header();
?>

<main id="main-content" class="students">
    <div class="container">
        <h1 class="section-title"><?php the_field('titre_etudiant', 'option') ?></h1>
        <?php 
            if (have_posts()){
                while (have_posts()){
                    the_post()
                    ?>
                    <article class="student">
                        <img loading="lazy" class="student-img" src="<?php the_post_thumbnail_url() ?>" />
                        <h2 class="student-name"><?php the_title() ?></h2>
                        <a href="<?php the_permalink() ?>" class="student-link"><?php the_field('titre', 'option');?></a>
                    </article>
                    <?php
                }
                // Boucle perso 
                // 1- Tableau Argument

                $args = array(
                    'post_type'         => 'etudiants'
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

                ?>
                <?php
            }
        ?>

    </div>
</main>

<?php 
    get_footer();
?>