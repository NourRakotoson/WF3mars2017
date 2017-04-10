$(document).ready(function(){

    // Fermer la modale
    $('.fa-times').click(function(){
        $('div').fadeOut();
    });

    // Supprimer les class error
    $('input, select').focus(function(){
        $(this).removeClass('error');
    });

    // Capter la soumission du formulaire
    $('form').submit(function(evt){

        // Bloquer le comportement naturel du formulaire
        event.preventDefault();

        // Définir les variables globales du formulaire
        var userName = $('[placeholder="Your name"]');
        var userEmail = $('[placeholder="Your email"]');
        var userSubject = $('select');
        var userMessage = $('textarea');
        var formScore = 0;
        
        // Vérifier que l'utilisateur a bien saisi son nom
        if(userName.val().length == 0){
            console.log('Nom obligatoire');
            // Ajouter la class error sur l'input
            userName.addClass('error');

        }else{
            console.log('Nom OK');
            // Incrémenter la valeur de la variable formScore
            formScore++;
        };


        // Vérifier que l'utilisateur a bien saisi au moins 4 caractères
        if(userEmail.val().length < 4){
            console.log('Email au moins 4 caractères')
            // Ajouter la class error sur l'input
            userEmail.addClass('error');
        }else{
            console.log('Email OK');
            // Incrémenter la valeur de la variable formScore
            formScore++;
        };


        // Vérifier que l'utilisateur a bien choisi un sujet
        if(userSubject.val() == 'null'){
            console.log('Sujet obligatoire');
            // Ajouter la class error sur l'input
            userSubject.addClass('error');
        }else{
            console.log('Sujet OK');
            // Incrémenter la valeur de la variable formScore
            formScore++;
        };


        // Vérifier que l'utilisateur a bien saisi au moins 5 caractères dans le message
        if(userMessage.val().length < 5 ){
            console.log('Au moins 5 caractères dans le message');
            // Ajouter la class error sur l'input
            userMessage.addClass('error');
        }else{
            console.log('Message OK');
            // Incrémenter la valeur de la variable formScore
            formScore++;
        };


        /*
            Validation finale du formulaire
        */
        if(formScore == 4){
            console.log(formScore);
            console.log('Le formulaire est validé !');

            // Envoi des données dans le fichier PHP
            // PHP répond true => continuer le traitement du formulaire

            // Afficher les données du formulaire dans une modale
            $('div span').text(userName.val());
            $('div b').text(userSubject.val());
            $('div p:last').text(userMessage.val());

            // Afficher la modale
            $('div').fadeIn();

            // Vider les champs du formulaire
            $('form')[0].reset();
        };

    });





});// Fin de chargement