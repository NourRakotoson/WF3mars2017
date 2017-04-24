//  Sélectionner la balise dans laquelle ajouter une autre balise
var myNavUl = document.querySelector('ul');

// Créer un tableau contenant 4 titres
var myArray = [ 'Accueil', 'About', 'Portfolio', 'Contacts' ]

// Faire une boucle sur le tableau
for( var i=0; i < myArray.length; i++ ){

    // Créer une variable pour générer une balise HTML
    var myNexTag = document.createElement('li');

    // Ajouter du contenu dans la balise générée
    myNexTag.innerHTML = '<a href="#">' + myArray[i] + '</a>';

    // Ajouter un enfant dans myMain
    myNavUl.appendChild( myNexTag );

}




