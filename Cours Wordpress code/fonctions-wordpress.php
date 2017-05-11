<?php
// Ne pas changer le nom de la fonction, elle est propre à Wordpress
register_sidebar(array(
    'name' => 'region du bas',
    'id' => 'region-du-bas',
    'description' => 'region en bas à gauche',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h1 class="widget-title">',
    'after_title' => '</h1>', 
));

/*
Explications : 
    name : nom de la région
    id : nom informatique de la région
    description : description de la région, utile pour rendre explicite auprès de l'administrateur
    before_widget : balise de début qui englobera chaque widget placé dans cette région
    after_wiidget : balise de fin qui englobera chaque widget placé dans cette région
    before_title : balise de début qui englobera chaque titre placé dans cette région
    after_title : balise de fin qui englobera chaque titre placé dans cette région    

A coller dans Apparences/Editeur/Twenty Twelve: Fonctions du thème (functions.php)
*/

dynamic_sidebar('region-du-bas'); // dynamic_sidebar permet de créer un espace pour les widgets
//A coller dans Apparences/Editeur/Twenty Twelve: Pied de page du thème (footer.php)
// Ouvrir une balise PHP et placer le code ci-dessus dans la div où l'on avait supprimé préalablement le lien <a> de Wordpress (ou là on veut placer le widget)
// Dans Apparence/widgets apparaît "region-du-bas", y ajouter le menu personnalisé, le selectionner et mettre à jour. 

// Télécharger le plugin CSS Classes. Déclarer une nouvelle classe dans le widget région du bas, puis revenir à l'éditeur, et modifier la feuille de style (à la toute fin hors des accolades).


// Ajouter un logo en haut à gauche
// création d'une nouvelle région
// placer dans le header entre les balises <hgroup></hggroup> sans supprimer le contenu, à positionner dans le code suivant où l'on veut le mettre'
//installer "image widget" pour placer un logo
register_sidebar(array(
    'name' => 'region du haut a gauche',
    'id' => 'region-du-haut-a-gauche',
    'description' => 'region en haut à droite',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h1 class="widget-title">',
    'after_title' => '</h1>', 
));

dynamic_sidebar('region-du-haut-a-gauche');

register_sidebar(array(
    'name' => 'region du haut au centre',
    'id' => 'region-du-haut-au-centre',
    'description' => 'region du haut au centre',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h1 class="widget-title">',
    'after_title' => '</h1>', 
));

dynamic_sidebar('region-du-haut-au-centre');

register_sidebar(array(
    'name' => 'region du haut à droite',
    'id' => 'region-du-haut-a-droite',
    'description' => 'region du haut à droite',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h1 class="widget-title">',
    'after_title' => '</h1>', 
));

dynamic_sidebar('region-du-haut-a-droite');

