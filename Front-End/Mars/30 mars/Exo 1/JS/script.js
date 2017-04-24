/*
    - Créer un tableau contenant 4 prénoms dont le votre
    - Faire une boucle sur le tableau pour saluer la console de chacun des prénoms

    - Afficher un message spécial pour votre prénom
*/

var namesArray = [ 'Chloé', 'Nour', 'Hery', 'Agnès' ];
console.log( namesArray );

for( var i = 0;  i < namesArray.length; i++ ){

    if( namesArray[i] == 'Nour' ){
        console.log ( 'Salut c\'est moi' );

        // Modifier une balise HTML
        document.querySelector('p').textContent = "Salut c'est moi !";

    }else{
        console.log( 'Salut ' + namesArray[i] );
    } 
};

