<?php
//---- REGION/WIDGET
add_action('widgets_init', 'e_projet_init_sidebar'); // j'exécute la fonction nommée "eprojet_init_sidebar". Ajoute un onglet Widget dans la sidebar du tableau de bord dans l'onglet Apparence
function e_projet_init_sidebar()
{
    if(function_exists('register_sidebar')) // si la fonction register_sidebar existe(c'est une fonction interne à WordPress), alors je déclare des régions
    {
        register_sidebar(array(
            'name'          => __('region-entete', 'eprojet'),
            'id'            =>    'region-entete',
            'description'   => __('Add widgets here to appear in your entent region', 'eprojet')          
        ));

        register_sidebar(array(
            'name'          => __('colonne de droite', 'eprojet'),
            'id'            =>    'colonne-droite',
            'description'   => __('Add widgets here to appear in your right colomn region', 'eprojet')          
        ));

        register_sidebar(array(
            'name'          => __('region-footer', 'eprojet'),
            'id'            =>    'region-footer',
            'description'   => __('Add widgets here to appear in your entent region', 'eprojet')          
        ));
    }
}

//---- MENU
add_action('init', 'eprojet_init_menu'); //add action permet d'ajouter notre propre fonction raccroché à des fonctions WP, j'exécute la fonction nommée "eprojet_init_menu". 
function eprojet_init_menu() // fonction qui contient la déclaration de mes régions
{
    if(function_exists('register_nav_menu')) // si la fonction register_nav_menu existe (c'est une fonction interne à WordPress), alors je déclare mes régions
    {
        register_nav_menu('primary', __('Primary Menu', 'eprojet'));
    }
}

function showCategory()
{
    $cat = ''; 
    $categories = get_categories(array('category_name' => 'ville', 'orderby' => 'name', 'exclude' => 1)); // on exclut la catégorie 1 appartenant à "non classé". 
    foreach($categories as $category)
    {
        $cat .= '<a href="'. get_category_link( $category->term_id ) .'">' . $category->name . '</a><br>';
    }
    return $cat;
}

// Fonction permettant de récupérer tous les contenus en fonction d'une catégorie
function showCategoryByPostType()
{
    $current_cat = get_query_var('cat');
    query_posts("post_type=$type&cat=$current_cat");
}

// Fonction permettant de récupérer toutes les images déposées dans le corps d'un texte
function getImage()
{
    $content = '';
    $images = get_children('post_parent=' . get_the_ID() . 'post_type=attachement&post_mine_type=image&post_per_page=10');
    foreach($images as $image_id =>$a)
    {
        $content .= wp_get_attachement($image_id, 'medium');
    }
    return $content;
}