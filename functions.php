<?php 

function fileLoadings(){
    //Style css

    wp_enqueue_style('baseCss', get_template_directory_uri(). '/assets/css/base.css', array(), 1.0);

    wp_enqueue_style('styleCss', get_template_directory_uri(). '/assets/css/style.css', array(), 1.0);

    // Script js

    wp_enqueue_script('detection', get_template_directory_uri(). '/assets/js/nav.js', array(), 1.0, true);
}

add_action('wp_enqueue_scripts', 'fileLoadings');

// Ajout du menu
register_nav_menus(
    array(
        'haut'          => 'Menu le plus haut pour mon site',
        'bas'           => 'Menu pour le bas de page',
        'bas_social'    => 'Menu social pour le bas de page'
    )
);

// Pour afficher les réseaux sociaux 
add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);

function my_wp_nav_menu_objects( $items, $args ) {
	
	// loop
	foreach( $items as &$item ) {
		// vars
		$icon = get_field('image_social', $item);
		// append icon
		if( $icon ) {
			$item->title = '<img loading="lazy"  src=" '. $icon['url'] .'" alt=" '. $icon['description'] .' ">';
		}
	}
	// return
	return $items;
}

// Ajout tag et image à la une 
function startup_special(){
    //Ajout des tags et image de mise en avant
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');

    // Ajout taille d'image
    add_image_size('img-news', 400, 260, true);
    add_image_size('img-formation', 617, 260, true);
    add_image_size('img-actualité', 840, 606, true);
    add_image_size('img-date', 16, 17, true);
}

add_action('after_setup_theme', 'startup_special');

// Function pour créer les Étudiants
function createPostTypeStudents(){

    $labels = array(
        'name'                  => __( 'Étudiants' ),
        'singular_name'         => __( 'Étudiant' ),
        'menu_name'             => __( 'Étudiants' ),
        'add_new'               => __( 'Ajouter' ),
        'add_new_item'          => __( 'Ajouter un étudiant' ),
        'edit_item'             => __( "Editer l'étudiant" ),
        'view_item'             => __( "Voir l'étudiant" ),
        'all_items'             => __( 'Tous les étudiants' ),
        'search_items'          => __( 'Tous les étudiants' ),
        'parent_item_colon'     => __( 'Étudiant parent:', 'textdomain' ),
        'not_found'             => __( 'Aucun étudiant' ),
        'not_found_in_trash'    => __( 'Aucun étudiant dans la corbeille.', 'textdomain' ),
    );
 
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'etudiant' ),
        'has_archive'        => true,
        'menu_position'      => 4,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
        'menu_icon'          => 'dashicons-id',
    );
    register_post_type( 'etudiant', $args );
}

add_action('init', 'createPostTypeStudents');

//Function pour créer les formations
function createPostTypeFormation(){

    $labels = array(
        'name'                  => __( 'Formations' ),
        'singular_name'         => __( 'Formation' ),
        'menu_name'             => __( 'Formations' ),
        'add_new'               => __( 'Ajouter' ),
        'add_new_item'          => __( 'Ajouter une formation' ),
        'edit_item'             => __( "Editer la formation" ),
        'view_item'             => __( "Voir la formation" ),
        'all_items'             => __( 'Toute les formations' ),
        'search_items'          => __( 'Toute les formations' ),
        'parent_item_colon'     => __( 'Formation parent:', 'textdomain' ),
        'not_found'             => __( 'Aucune formation' ),
        'not_found_in_trash'    => __( 'Aucune formation dans la corbeille.', 'textdomain' ),
    );
 
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'formation' ),
        'has_archive'        => true,
        'menu_position'      => 4,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
        'menu_icon'          => 'dashicons-embed-generic',
    );
    register_post_type( 'formation', $args );
}

add_action('init', 'createPostTypeFormation');

// Pour créer les pages d'options
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'En savoir plus',
		'menu_title'	=> "Page d'options",
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

    acf_add_options_sub_page(array(
		'page_title' 	=> 'Paramètres Formation / Étudiants',
		'menu_title'	=> 'Informations',
		'parent_slug'	=> 'theme-general-settings',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Paramètres Adresse Footer',
		'menu_title'	=> 'Adresse Footer',
		'parent_slug'	=> 'theme-general-settings',
	));
}

// Pour la pagination
function bittersweet_pagination() {
    global $wp_query;

    if ( $wp_query->max_num_pages <= 1 ) return; 
    
    $big = 999999999;
    
    $pages = paginate_links( array(
        'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format'    => '?paged=%#%',
        'current'   => max( 1, get_query_var('paged') ),
        'total'     => $wp_query->max_num_pages,
        'type'      => 'array',
		'next_text' => '»',
		'prev_text' => '«',
    ));
    if( is_array( $pages ) ) {
        $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
        echo '<ul class="pagination-list">';
        foreach ( $pages as $page ) {
                echo "<li class='pagination-item'>".str_replace('page-numbers', 'pagination-link', $page)."</li>";
        }
        echo '</ul>';
    }
}


// Function pour choisir le nombre de post par page dans la section "étudiant"
function paginationEtudiant( $query ) {
    if ( !is_admin() && $query->is_main_query() && is_post_type_archive( 'etudiant' ) ) {
            $query->set( 'posts_per_page', '8' );
    }
}
add_action( 'pre_get_posts', 'paginationEtudiant' );

// Function pour choisir le nombre de post par page dans la section "formation"
function paginationFormation( $query ) {
    if ( !is_admin() && $query->is_main_query() && is_post_type_archive( 'formation' ) ) {
            $query->set( 'posts_per_page', '4' );
    }
}
add_action( 'pre_get_posts', 'paginationFormation' );

// Pour ajouter une class dans le menu active quand on est sur une single 
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);
function special_nav_class($classes, $item){
    if (is_singular('formation')){
        if(in_array('menu-item-259', $classes, true)){
            $classes[] = 'current-menu-item ';
        }
        
    }else if (is_singular('etudiant')){
        if(in_array('menu-item-183', $classes, true)){
            $classes[] = 'current-menu-item ';
        }
    }else if (is_singular('post')){
        if(in_array('menu-item-21', $classes, true)){
            $classes[] = 'current-menu-item ';
        }
    }
    
    return $classes;    
     
}

// Pour enlever la balise p du form
add_filter('wpcf7_autop_or_not', '__return_false');

// Modification du button dans le formulaire
remove_action('wpcf7_init', 'wpcf7_add_form_tag_submit');
add_action('wpcf7_init', 'twentysixteen_child_cf7_button');
if (!function_exists('twentysixteen_child_cf7_button')) {
    function twentysixteen_child_cf7_button() {
    wpcf7_add_form_tag('submit', 'twentysixteen_child_cf7_button_handler');
    }
}

// Modification du <submit> par <button> et ajout du champ ACF
if (!function_exists('twentysixteen_child_cf7_button_handler')) {
    function twentysixteen_child_cf7_button_handler($tag) {
    $tag = new WPCF7_FormTag($tag);
    $class = wpcf7_form_controls_class($tag->type);
    $atts = array();
    $atts['class'] = $tag->get_class_option($class);
    $atts['class'] .= ' twentysixteen-child-custom-btn';
    $atts['id'] = $tag->get_id_option();
    $atts['tabindex'] = $tag->get_option('tabindex', 'int', true);
    $value = isset($tag->values[0]) ? $tag->values[0] : '';
    if (empty($value)) {
    $value = esc_html__('Contact Us', 'twentysixteen');
    }
    $atts['type'] = 'submit';
    $atts = wpcf7_format_atts($atts);
    $image = get_field('image_envoyer', 'option');
    $html = sprintf('<button type="submit"><span class="twentysixteen-child-custom-btn-text">%2$s</span><img loading="lazy" src="'. $image['url'] .'" alt="" aria-hidden="true"></button>', $atts, $value);
    return $html;
    }
}