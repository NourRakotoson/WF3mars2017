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

            // Afficher le titre du projet
            var modalTitle = $(this).prev().text()
            $('#modal span').text(modalTitle);

            // Afficher l'image du projet
            var modalImage = $(this).parent().prev().attr('src')
            $('#modal img').attr( 'src', modalImage ).attr('alt', modalTitle);

            // Afficher la modale
            $('#modal').fadeIn();
        });

        // Fermer les modales
        $('.fa-times').click(function(){
            $('#modal').fadeOut();
        });
    };

    // Créer une fonction pour la gestion du formulaire
    function contactForm(){

        // Capter le focus sur les input et le textarea
        $('input:not([type="submit"]), textarea').focus( function(){

            // Sélectionner la balise précédente pour y ajouter la class openedLabel
            $(this).prev().addClass('openedLabel hideError');
        });

        // Capter le blur sur les inputs et le textarea
        $('input,textarea').blur(function(){

            // Vérifier s'il y a des caractères dans le input
            if($(this).val().length == 0){

                 // Sélectionner la balise précédente pour supprimer la class openedLabel
                $(this).prev().removeClass();
            };           
        });

        // Capter le blur sur les inputs et le textarea
        $('select').focus(function(){

            $(this).prev().removeClass();
            $(this).prev().addClass('hideError');
        });

        // Supprimer le message d'erreur du select
        $('select').focus(function(){
            $(this).prev().addClass('hideError');
        });

        // Supprimer le message d'erreur de la checkbox
        $('[type="checkbox"]').focus(function(){

            if($(this)[0].checked == false){
                $('form p').addClass('hideError');
            } else{
                 $('form p').removeClass()
            };   
        });

        // Fermer la modale
        $('.fa-times').click(function(){
            $('#modal').fadeOut();
        });

        // Capter la soumission du formulaire
        $('form').submit(function(evt){

            // Bloquer le comportement naturel du formulaire
            evt.preventDefault();

            // Définir les variables globales du formulaire 
            var userName = $('#userName');
            var userEmail = $('#userEmail');
            var userSubject = $('#userSubject');
            var userMessage = $('#userMessage');
            var checkbox = $('[type="checkbox"]');
            var formScore = 0;

            // Vérifier qu'userName a au minimum 2 caractères
            if(userName.val().length < 2){
                $('[for=userName] b').text(' Minimum 2 caractères');
                // version 2 : userName.prev().children('b').text('Minimum 2 caractères');

            }else{
                // Incrémenter la valeur de formScore
                formScore ++;
            };

            // Vérifier qu'userEmail a au moins 5 caractères
            if(userEmail.val().length < 5){
                 $('[for=userEmail] b').text(' Minimum 5 caractères');
            }else{
               // Incrémenter la valeur de formScore
                formScore ++;
            };

            // Vérifier que l'utilisateur a bien selectionné un sujet
            if(userSubject.val() == 'null'){
               $('[for=userSubject] b').text(' Vous devez choisir un sujet');
            }else{
                // Incrémenter la valeur de formScore
                formScore ++;
            };

            // Vérifier qu'il y a moins 5 caractères dans userMessage
            if(userMessage.val().length < 5){
                $('[for=userMessage] b').text(' Minimum 5 caractères');
            }else{
                formScore ++;
            };

            // Vérifier si la checkbox a été cochée
            if(checkbox[0].checked == false){
                $('form p b').text(' Vous devez accepter les Conditions Générales');
            }else{
                formScore ++;
            };

            // Validation finale du formulaire
           if(formScore == 5){
                console.log(' Le formulaire est validé !');

                // Envoi des données dans le fichier de traitement PHP
                // PHP répond true => continuer le traitement du formulaire

                    // Ajouter la valeur de userName dans la balise h2 span de la modale
                    $('#modal span').text( userName.val() );

                    // Afficher la modale
                    $('#modal').fadeIn();

                    // Vider les champs du formulaire
                    $('form')[0].reset();

                    // Supprimer les messages d'erreur
                    $('form b').text('');

                    // Replacer les labels
                    $('label').removeClass();
           };

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

            // Créer une variable pour récupérer la valeur de l'attribut href 
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

                            // Vérifier si l'utilisateur est sur la page contacts.html
                            if( viewToLoad == 'contacts.html' ){

                                // Déclencher la fonction de gestion du formulaire
                                contactForm();
                            };

                        });

                    });

                });

            });


}); // Fin de la fonction d'attente de chargement du DOM