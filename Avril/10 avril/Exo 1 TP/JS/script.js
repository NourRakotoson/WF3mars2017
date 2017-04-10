// Attendre la fonction de chargement du DOM
$(document).ready( function(){

            // Capter la soumission du formulaire
            $('form').submit(function(evt){

                // Bloquer le comportement naturel du formulaire
                evt.preventDefault();
                
                // Définir les variables globales du formulaire 
                var userName = $('#userName');
                var userPhone = $('#userPhone');
                var userSubject = $('#userSubject');
                var userMessage = $('#userMessage');
                var formScore = 0;

                // Vérifier qu'userName a au minimum 2 caractères
                if(userName.val().length < 2){
                    $('[for=userName] b').text(' Minimum 2 caractères');
                }else{
                    // Incrémenter la valeur de formScore
                    formScore ++;
                };

                // Vérifier qu'userPhone a au moins 5 caractères
                if(userPhone.val().length < 5){
                    $('[for=userPhone] b').text(' Minimum 5 caractères');
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

                // Validation finale du formulaire
                if(formScore == 4 ){
                    $('form p').text('Merci! Nous vous recontacterons dans les plus brefs délais');
                
                    // Envoi des données dans le fichier de traitement PHP
                    // PHP répond true => continuer le traitement du formulaire

                    // Vider les champs du formulaire
                    $('form')[0].reset();

                    // Supprimer les messages d'erreur
                    $('form b').text('');

                    // Replacer les labels
                    $('label').removeClass();
                }else{
                    $('form p').text('Veuillez remplir les champs du formulaire')
                };

            });
    
       







}); // Fin de la fonction d'attente de chargement du DOM