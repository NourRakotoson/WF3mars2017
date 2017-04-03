/*
    Créer une fonction qui permet à l'utilisateur de choisir une couleur 
*/

var userChoice = '';
console.log( userChoice );

function chooseColor(){

    // Code à exécuter lorsque la fonction est appelée
    var userPrompt = prompt('Choisir une couleur entre rouge, vert et bleu');

    // Assigner la valeur de userPrompt à userChoice
    userChoice = userPrompt;

    // Appeler la fonction de traduction
    translateColor( userChoice );
};

// Créer une fonction pour traduire les couleurs 
function translateColor( paramColor ){

    // Utilisation du switch 
    switch(paramColor){

        // 1er cas: paramColor est égale à 'rouge'
        case 'rouge': console.log('Rouge=Red'); 
        break;

        // 2ème cas: paramColor est égale à 'vert'
        case 'vert' : console.log('Vert=Green');
        break;

        // 3ème cas : paramColor est égal à 'bleu'
        case 'bleu' : console.log('Bleu=Blue');
        break;

        // Pour tous les autres cas : default est OBLIGATOIRE
        default: console.log('Je ne connais pas cette couleur');
        break;
    }
   
};

