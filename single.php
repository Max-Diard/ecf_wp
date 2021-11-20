<?php
    get_header();
?>

<main id="main-content" class="post">
    <div class="container container-narrow">
        <?php
        if(have_posts()){
            while(have_posts()){
                the_post();
                ?>
                <img loading="lazy"  src="<?php the_post_thumbnail_url('img-actualité') ?>" alt="<?php the_post_thumbnail_caption() ?>" class="featured-img">
                <h1><?php the_title() ?></h1>
                <p class="post-date"><img class='post-date-before' src='<?php
                    $image = get_field('image_date', 'option');
                    echo $image['sizes']['img-date'];
                ?>' alt=''/><?php the_date() ?></p>
                <p><?php the_content() ?></p>
                        
                <?php
            }
        }
        ?>
    </div>
</main>

<?php 
    get_footer();
?>