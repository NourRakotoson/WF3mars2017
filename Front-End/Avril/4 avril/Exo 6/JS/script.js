// Attendre la fonction de chargement du DOM
$(document).ready(function(){

/*
Home Page
*/
    // Burger menu 
    $('.homePage h1 + a').click(function(evt){

        // Bloquer le comportement naturel de la balise a 
        evt.preventDefault();

        // Appliquer la fonction slideToggle sur la nav
        $('.homePage nav').slideToggle();

    });

    // Burger Menu : navigation
    $('.homePage nav a').click(function(evt){

        // Bloquer le comportement naturel de la balise a 
        evt.preventDefault();

        var linkToOpen = $(this).attr('href');

        // Fermer le Burger Menu 
        $('.homePage nav').slideUp(function(){

            // Changer de page
            window.location = linkToOpen;
        });

    });

/*
About Page 
*/
    // Capter le clic sur le Burger Menu
    $('.aboutPage h1 + a').click(function(evt){

        // Bloquer le comportement naturel de la balise a 
        evt.preventDefault();

        // Sélectionner la nav pour y appliquer une fonction animate
        $('.aboutPage nav').animate({
            left:'0'
        });
    });

    // Burger Menu : navigation
    $('.aboutPage nav a').click(function(evt){

        // Bloquer le comportement naturel de la balise a 
        evt.preventDefault();

        var linkToOpen = $(this).attr('href');

        // Fermer le Burger Menu 
        $('.aboutPage nav').animate({
            left: '-100%'

        }, function(){

            // Changer de page
            window.location = linkToOpen;
        });

    });


}); // Fin de la fonction d'attente de chargement du DOM