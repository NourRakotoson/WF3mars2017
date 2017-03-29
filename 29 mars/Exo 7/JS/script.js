/*
Le Chifoumi
- L'utilisateur doit choisir entre pierre, feuille et ciseaux
- L'ordinateur doit choisir entre pierre, feuille et ciseaux
- Nous comparons le choix de l'utilisateur et de l'ordinateur
- Selon le résultat, l'utilisateur ou l'ordinateur a gagné
- Une partie se joue en 3 manches gagnantes
*/

// Variable globale pour le choix de l'utilisateur
var userBet = "";
var userWin = 0;
var computerWin = 0;

/* 
    1# L'utilisateur doit choisir entre pierre, feuille et ciseaux
    - Créer une fonction qui prend en parallèle le choix de l'utilisateur
    - Appeler la fonction au clic sur les buttons du DOM en précisant le paramètre
    - Afficher le résultat dans la console
*/

function userChoice( paramChoice ){

    // Assigner à la variable userBet la valeur de paramChoice
    userBet = paramChoice;
};

/* 
    2# L'ordinateur doit choisir entre pierre, feuille et ciseaux
    - Faire une fonction pour déclencher le choix au clic sur un bouton
    - Créer un tableau contenant 'pierre','feuille' et 'ciseaux'
    - Faire en sorte de choisir aléatoirement l'un des 3 index du tableau
    - Afficher le résultat dans la console
*/

function computerChoice(){

    var computerMemory = [ 'Pierre', 'Feuille', 'Ciseaux' ];

    //  Choisir aléatoirement l'un des 3 index du tableau
    var computerBet = computerMemory[Math.floor(Math.random() * computerMemory.length)];

    // Vérifier si userBet est vide
    if( userBet == '' ){
        document.querySelector('h2').innerHTML = 'Peak your <i>weapon</i>';

    } else{

            // Afficher les deux choix dans la balise h2
            document.querySelector('h2').textContent = userBet + ' vs. ' + computerBet;
        
        // Comparer les variables
        if( userBet == computerBet ){
            document.querySelector('p').textContent = 'So close';

        } else if( userBet == 'Pierre' && computerBet == 'Ciseaux' ){
            document.querySelector('p').textContent = 'Wiiiiiin';
            
            // Incrémenter la variable userWin de 1
            userWin++;
        
        } else if ( userBet == 'Feuille' && computerBet == 'Pierre' ){  
            document.querySelector('p').textContent = 'Wiiiiiin';  

            // Incrémenter la variable userWin de 1
            userWin++;      

        } else if ( userBet == 'Ciseaux' && computerBet == 'Feuille' ){
            document.querySelector('p').textContent = 'Wiiiiiin';    

            // Incrémenter la variable userWin de 1
            userWin++;

        } else{
            document.querySelector('p').textContent = 'Looser!';   

            // Incrémenter la variable computerWin de 1
            computerWin++;     
        };
    };

    // Vérifier les valeurs de userWin et computerWin
    if( userWin == 3){
        console.log ('Wiiiiiin');

        // Afficher le message dans le body
        document.querySelector( 'body' ).innerHTML = '<h1>All I do is win win win No matter what</h1><a href="index.html">More</a>';
    };

    if( computerWin == 3 ){
        document.querySelector( 'body' ).innerHTML = '<h1>Loose with grace</h1><a href="index.html">More</a>';
    };
};
