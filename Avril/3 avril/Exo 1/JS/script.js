// Attendre le chargement du DOM
$(document).ready(function(){

    // Créer un tableau vide pour enregistrer les avatars 
    var myTown = [];

    // Vérifier le genre de l'avatar
    var avatarWoman = $('#avatarWoman');
    var avatarMan = $('#avatarMan');
    var avatarGender;

     // => avatarWoman capter le clic
    avatarWoman.click(function(){
       
        // Désactiver avatarMan
        avatarMan.prop('checked', false);

        // Modifier la valeur de avatarGender
        avatarGender = avatarWoman.val(); // =>girl

        // Vider le message d'erreur
        $('.labelGender b').text('');

        // Modifier l'attribut src de #avatarBody
        $('#avatarBody').attr('src','img/' + avatarGender + '.png'); 
    });    

    // => avatarMan capter le clic
    avatarMan.click(function(){

        // Désativer avatarWoman
        avatarWoman.prop('checked', false);

        // Modifier la valeur de avatarGender
        avatarGender = avatarMan.val(); // =>boy

        // Vider le message d'erreur
        $('.labelGender b').text('');

        // Modifier l'attribut src de #avatarBody
        $('#avatarBody').attr('src','img/' + avatarGender + '.png');

    });

    // Supprimer les messages d'erreur
    $('input,select').focus( function(){

        // Sélectionner la balise précédent le input
        $(this).prev().children('b').text('');
    });

    // Capter l'évènement change () sur les selects
    $('select').change(function(){

        $(this).attr('id'), ' change : ' + $(this).val();

        // Condition if pour modifier la valeur src de avatarTop ou avatarBottom 
        if( $(this).attr('id') == 'avatarStyleTop'){

            // Modifier la valeur de l'attribut src de #avatarTop
            $('#avatarTop').attr('src', 'img/top/' + $(this).val() + '.png');

        } else{
            $('#avatarBottom').attr('src', 'img/bottom/' + $(this).val() + '.png');
        };
    });

    // Capter la soumission du formulaire
    $('form').submit( function(evt){

        // Bloquer le comportement par défaut du formulaire
        evt.preventDefault();

        // Définir une variable pour la validation finale du formulaire
        var formScore = 0;

        // Variables globales du formulaire (toujours après la soumission du formulaire sinon valeurs vides)
        var avatarName = $('#avatarName').val();
        var avatarAge = $('#avatarAge').val();

        var avatarStyleTop = $('#avatarStyleTop').val();
        var avatarStyleBottom = $('#avatarStyleBottom').val();
        
        // Vérifier les champs du formulaire
            // => avatarName minimum 5 caractères
            if ( avatarName.length < 4 ){
                // Ajouter un message d'erreur dans le label
                $('[for="avatarName"] b').text('Minimum 5 caractères');

            }else{
                // Incrémenter la variable formScore
                formScore++;
            };

            // => avatarAge entre 1 et 100
            if (avatarAge == 0 || avatarAge > 100 || avatarAge.length == 0){
                // Ajouter un message d'erreur dans le label
                $('[for="avatarAge"] b').text('Entre 1 et 100 ans');

            }else{
                // Incrémenter la variable formScore
                formScore++;
            };

            // => avatarStyleTop obligatoire
            if( avatarStyleTop == 'null' ){
                // Ajouter un message d'erreur dans le label
                $('[for="avatarStyleTop"] b').text('Choix Obligatoire');
            }else{
                // Incrémenter la variable formScore
                formScore++;
            };

            // => avatarStyleBottom obligatoire
            if( avatarStyleBottom == 'null' ){
                // Ajouter un message d'erreur dans le label
                $('[for="avatarStyleBottom"] b').text('Choix Obligatoire');
            }else{
                // Incrémenter la variable formScore
                formScore++;
            };

            // => avatarGender vérifier la valeur
            if( avatarGender == undefined ){ 
                // Ajouter un message d'erreur dans .labelGender
                $('.labelGender b').text('Choix Obligatoire');
            }else{
                // Incrémenter la variable formScore
                formScore++;
            };

        // Vérifier la valeur de la variable formScore
        if( formScore == 5 ){
            console.log('Le formulaire est validé !');

            // Ajouter une ligne dans le tableau html (avant de vider les champs du formulaire)
            $('table').append('' +
            '<tr>' +
                '<td><b>'+ avatarName +'</b></td>' +
                '<td>'+ avatarAge +' an(s)</td>' +
                '<td>'+ avatarGender +'</td>' +
                '<td>'+ avatarStyleTop + ', ' + avatarStyleBottom +'</td>' +
                '</tr>'
            );

            // Ajouter l'avatar dans le tableau JS
            myTown.push({ 
                name: avatarName,
                age: parseInt(avatarAge),
                gender: avatarGender,
                top: avatarStyleTop,
                bottom: avatarStyleBottom
            });


            // => Envoyer les données du formulaire et attendre la réponse du serveur en Ajax
            // => Le serveur répond true

                // Vider les champs du formulaire
                $('form')[0].reset();

                // Revenir aux valeurs 'null'pour l'avatar
                // Modifier l'attribut src de #avatarBody
                $('#avatarBody').attr('src','img/null.png');
                $('#avatarTop').attr('src','img/top/null.png');
                $('#avatarBottom').attr('src','img/bottom/null.png');

                // Afficher la taille totale de la ville dans #totalSims
                $('#totalSims').text( myTown.length );

                // Définir les variables globales pour les statistiques
                var totalGirls = 0;
                var totalBoys = 0;
                var totalAge = 0;

                // Faire une boucle for sur myTown pour connaître les statistiques
                for( var i = 0; i < myTown.length; i++ ){

                    // Condition pour le gender
                    if( myTown[i].gender == 'Girl' ){
                        totalGirls++;

                    }else{
                        totalBoys++;
                    }

                    // Additionner les âges
                    totalAge += myTown[i].age;
                };
                // Affficher dans le tableau HTML le nombre de girls et le nombre de boys
                $('#simsWoman').html(totalGirls + '<b>/' + myTown.length + '</b>');
                $('#simsMan').html(totalBoys + '<b>/' + myTown.length + '</b>');

                // Afficher l'âge moyen dans le tableau HTML
                var ageAmount =  Math.round ( totalAge / myTown.length );
                $('#simsAgeAmount').html( ageAmount + '<b>ans</b>' );
                
        };
        
        
    });
       
    




});// Fin de la fonction d'attente de chargement du DOM 