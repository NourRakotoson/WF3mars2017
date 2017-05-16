<?php
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles(){
wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}

// par convention, ce fichier doit obligatoirement s'appeler 'functions' au pluriel
// ce code permet de récupérer le fichier css du theme parent :
// la fonction add_action permet d'accrocher le fichier style du theme parent, le fichier style du theme enfant, ce que l'on appelle un 'hook'
