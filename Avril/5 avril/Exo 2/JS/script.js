// Attendre la fonction de chargement du DOM
$(document).ready(function(){

    // Créer une fonction pour l'animation d'une compétence
    function mySkills( paramEq, paramWidth ){

        // Animation des balises p des skills
        $('h3 + ul').children('li').eq(paramEq).find('p').animate({
            width: paramWidth
        });
    };

    // Créer une fonction pour ouvrir la modale
    function openModal(){

        // Créer une fonction pour l'ouverture des modales
        $('button').click(function(){
            $('#modal').fadeIn();
        });

        // Fermer les modales
        $('.fa-times').click(function(){
            $('#modal').fadeOut();
        });
    };

    // Charger le contenu de home.html dans le main
    $('main').load( 'views/home.html' );

/*
BurgerMenu
*/
    // Burger menu : ouverture
        $('h1 + a').click(function(evt){

            // Bloquer le comportement naturel de la balise a 
            evt.preventDefault();

            // Appliquer la fonction slideToggle sur la nav (afficher Burger Menu)
            $('nav').slideToggle();

            });

            // Burger Menu : navigation
            $('nav a').click(function(evt){

                // Bloquer le comportement naturel de la balise a 
                evt.preventDefault();

                // Masquer le main
                $('main').fadeOut();

                var viewToLoad = $(this).attr('href');

                // Fermer le Burger Menu 
                $('nav').slideUp(function(){

                    // Charger la bonne vue puis afficher le main (callBack)
                    $('main').load('views/' + viewToLoad, function(){

                        $('main').fadeIn(function(){

                            // Vérifier si l'utilisateur veut voir la page about.html
                            if( viewToLoad == 'about.html' ){

                                // Appeler la fonction mySkills
                                mySkills( 0, '80%' );
                                mySkills( 1, '50%' );
                                mySkills( 2, '30%' );                            
                            };

                            // Vérifier si l'utilisateur est sur la page portfolio.html
                            if( viewToLoad == 'portfolio.html' ){

                                // Appeler la fonction pour ouvrir la modale
                                openModal();                            
                            };
                        });
                    });
                });


            });


}); // Fin de la fonction d'attente de chargement du DOM