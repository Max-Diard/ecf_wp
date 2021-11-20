<?php
// Template Name: Page Contact
    get_header();
?>

<main id="main-content">
    <div class="container">
        <h1><?php the_title() ?></h1>
        <?php echo do_shortcode('[contact-form-7 id="6" title="Formulaire de contact" html_class="contact-form"]'); ?>
    </div>
</main>

<?php 
    get_footer();
?>