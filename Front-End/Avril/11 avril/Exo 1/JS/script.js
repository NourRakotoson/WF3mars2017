// Attendre le chargement du DOM
$(document).ready(function(){

    // Définir une variable pour la sélection des checkbox
    var boxChecked

    // UserInterface checkbox
    $('[type="checkbox"]').click(function(){
        // console.log($(this)[0].checked);

        // Définir la variable boxCheked
        boxChecked = $(this).val();

        var checkboxArray = $('[type="checkbox"]').not($(this))
       
       for( var i = 0; i < checkboxArray.length; i++ ){
            // console.log(checkboxArray[i]);

            // Décocher les checkboxs
            checkboxArray[i].checked = false;
       };

            //Modifier l'image
            if($(this).val() == 'first'){
                // console.log('first');
                $('img').attr('src', 'IMG/fabrics1.jpg');                

            }else if($(this).val() == 'second'){
                // console.log('second')
                $('img').attr('src', 'IMG/fabrics2.jpg');

            }else if($(this).val() == 'third'){
                // console.log('third')
                $('img').attr('src', 'IMG/fabrics3.jpg');               

            }else{
                // console.log('fourth')
                $('img').attr('src', 'IMG/fabrics4.jpg');              

            };

    });

    // Capter la soummission du formulaire
    $('form').submit(function(evt){

        // Bloquer le comportement par défaut du formulaire
        evt.preventDefault();

        // console.log('Submit OK');

        // Savoir quellle checkbox est sélectionnée
        // var firstCheckbox = $('[value="first"]');
        // console.log(firstCheckbox[0].checked);

        // Vérifier que la variable créée au-dessus fonctionne
        // console.log(boxChecked);

        if(boxChecked == undefined){
            console.log('Vous devez choisir une image');
        }else{
            // Afficher la modale
            $('#modal').fadeIn();
        }

       



    });




});// Fin de la fonction de chargement du DOM