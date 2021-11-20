<?php
    get_header();
?>

<main id="main-content" class="student-post">
		<div class="container">
			<img loading="lazy"  src="<?php the_post_thumbnail_url() ?>" alt="<?php the_post_thumbnail_caption() ?>" class="student-post-img" />
			<h1 class="student-post-title"><?php the_title() ?></h1>
            <?php
                if(have_rows('portrait_chinois')){
                    while(have_rows('portrait_chinois')){
                        the_row();
                        $title = get_sub_field('titre');
                        $text = get_sub_field('texte');
                        ?>
                        <div class="field">
                            <div class="field-title"><?php echo $title ?></div>
                            <div class="field-content"><?php echo $text ?></div>
                        </div>
                        <?php
                    }
                }
            ?>
			
			<div class="field">
				<div class="field-title"><?php the_field('titre_presentation') ?></div>
				<div class="field-content"><?php the_field('presentation') ?></div>
			</div>
		</div>
	</main>

<?php
    get_footer();
?>