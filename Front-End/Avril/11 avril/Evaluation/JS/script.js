$(document).ready(function(){

    // Supprimer les class error
    $('select, textarea').focus(function(){
        $(this).removeClass('error');
    });

    // Capter l'évènement change() sur le select
    $('select').change(function(){
        if ($(this).val() == 'null' ){
            $('#imgCat').attr('src', 'IMG/chat_0.jpg');

        }else if ($(this).val() == 'Maki'){ 
            $('#imgCat').attr('src', 'IMG/chat_2.jpg'); 

         }else if ($(this).val() == 'Sashimi'){ 
            $('#imgCat').attr('src', 'IMG/chat_3.jpg');

        }else if ($(this).val() == 'Yakitori'){ 
            $('#imgCat').attr('src', 'IMG/chat_4.jpg');

        }else if ($(this).val() == 'Onigri'){ 
            $('#imgCat').attr('src', 'IMG/chat_5.jpg');

        }else{ $('#imgCat').attr('src', 'IMG/chat_1.jpg');  
        };
    });


    // Capter la soummission du formulaire
    $('form').submit(function(evt){

        // Bloquer le comportement par défaut du formulaire
        evt.preventDefault();
       
       // Définir les variables globales du formulaire
       var selectChat = $('select');
       var userMessage = $('#userMessage');
       var formScore = 0;

        // Vérifier que l'utilisateur a bien choisi un chat
        if(selectChat.val() == 'null'){
            // Ajouter la class error sur le select
            selectChat.addClass('error');
        }else{
            // Incrémenter la valeur de la variable formScore
            formScore++;
        };

        // Vérifier que l'utilisateur a bien saisi au moins 15 caractères dans le message
        if(userMessage.val().length < 14 ){
            // Ajouter la class error sur l'input
            userMessage.addClass('error');
        }else{
            // Incrémenter la valeur de la variable formScore
            formScore++;
        };

        /*
            Validation finale du formulaire
        */
        if(formScore == 2){
            
            // Envoi des données dans le fichier PHP
            // PHP répond true => continuer le traitement du formulaire

            // Replacer l'image du chat 0 et remplacer le formulaire par un texte
            $('#imgCat').attr('src', 'IMG/chat_0.jpg');
            $('form').text('Merci, nous répondrons à votre demande prochainement');
        };
       
    });

});// Fin de la fonction de chargement du DOM