// Attendre le chargement du DOM
$(document).ready(function(){

    // Fonction animate ()
    $('section:first button').click(function(){
        
        // Changer la largeur et la hauteur de l'article
        $('section:first article').animate({
            width:'20rem',
            height: '40rem'
        });
    });

    // Fonction animate() valeurs dynamiques
    $('section:nth-child(2) button').click(function(){

        $('section:nth-child(2) article').animate({

            // Pas d'espace entre += et la valeur
            left: '+=1rem',
            top: '-=1rem',
        });
    });

    // Fonction animate() : toggle/show/hide
    $('section:nth-child(3) button').click(function(){

        $('section:nth-child(3) article').animate({

            width: 'toggle'
        });
    });

    // Utiliser la fonction animate() avec durée et callBack
    $('section:last button').click(function(){

        $('section:last article').animate({
        width: '20rem',
        height:'20rem'
    }, 2000, function(){

            // Supprimer la balise après l'animation
            $(this).hide();
        });  
    });
   





});// Fin de la fonction de chargement du DOM