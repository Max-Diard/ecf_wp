<?php
    get_header();
?>

<main id="main-content" class="post">
    <?php 
    if(have_posts()){
        while(have_posts()){
            the_post();
            ?>
            <div class="container container-narrow">
            <h1><?php the_title() ?></h1>
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