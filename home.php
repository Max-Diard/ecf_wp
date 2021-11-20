<?php
    get_header();
?>

<main id="main-content" class="last-news">
    <div class="container">
        <h1 class="section-title"><?php echo get_the_title(14) ?></h1>
        <?php 
        if (have_posts()){
            while (have_posts()){
                the_post()
                ?>
                <article class="card">
                <img loading="lazy"  src="<?php the_post_thumbnail_url('img-actualites') ?>" alt="<?php the_post_thumbnail_caption() ?>" class="card-img">
                <div class="card-content">
                    <p class="card-date">
                        <img class='card-date-before' src='<?php
                            $image = get_field('image_date', 'option');
                            echo $image['sizes']['img-date'];
                        ?>' alt=''/><?php echo get_the_date() ?></p>
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
        }
    ?>

        <nav class="pagination">
            <?php bittersweet_pagination() ?>
        </nav>
    </div>
</main>

<?php
    get_footer();
?>