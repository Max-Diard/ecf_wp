<!DOCTYPE html>
<html <?php language_attributes(); ?> >
<head>
	<meta charset="<?php bloginfo('charset') ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php the_field('onglet_titre', 'option') ?></title>
    <?php wp_head() ?>
</head>


<?php 
	if (is_front_page()){
		$bodyClass = 'home';
	}
	else if (is_singular('formation')){
		$bodyClass = 'formation-simple';
	}
	else{
		$bodyClass = '';
	}
?>
<body <?php body_class($bodyClass);?>>

<?php wp_body_open();?>

<?php get_template_part('part/top') ?>

