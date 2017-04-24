// Attendre le chargement du DOM
$(document).ready( function(){

    // Manipuler le contenu du footer
    console.log( $('footer').text() );
    $('footer').text('Sous la licence MIT');
    
    // Manipuler le contenu HTML du footer
    console.log( $('footer').html() );
    $('footer').html('Sous la licence <b>MIT</b>');

    // Créer un objet pour le contenu des pages
    
        var content = {

            homeContent = {
            title: 'Bienvenue sur mon site',
            content: 'Je suis le texte de la page <b>Accueil</b>'
        },

        
            portfolioContent = {
            title: 'Bienvenue sur mon Portfolio',
            content: 'Je suis le texte de la page <b>Portfolio</b>'
        },

            contactContent = {
            title: 'Bienvenue sur la page Contacts',
            content: 'Je suis le texte de la page <b>Contacts</b>'
        }
    }

    // Créer une fonction pour gérer le menu
    function showMyContent(){

        // Capter le clic sur la première li 
        $('li').click( function(){

            // Récupérer la valeur de l'attribut data
            var dataValue = $(this).attr('data');

        // Modifier le contenu de la balise h2
        $('h2').text( content.dataValue.title );

        // Modifier le contenu de la balise p
        $('p').html( content.dataValue.content );

        });

    };

    showMyContent();


});// Fin de la fonction de chargement du DOM