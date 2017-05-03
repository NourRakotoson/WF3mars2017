<?php

// Exercice: 
/*
    - Dans le fichier listeFruits.php : créer 3 liens banane, kiwi et cerises. Quand on clique sur les liens, on passe par le nom du fruit dans l'URL à la page couleur.php. 

    - Dans couleur.php : vous récupérez le nom du fruit et affichez sa couleur.   

    Notez que vous ne passez pas la couleur dans l'URL mais vous la déduisez dans couleur.php. 
*/

// print_r($_GET); vérifier que les informations de liste.Fruit.php sont bien aspirées par couleur.php

if (isset($_GET['fruit'])) {
    echo 'Fruit : ' . $_GET['fruit'] . '<br>';

    if ($_GET['fruit'] == 'banane') {
        echo ' Couleur du fruit : Jaune <br>';
    } elseif ($_GET['fruit'] == 'kiwi') {
        echo 'Couleur du fruit: Vert <br>';
    } else if ($_GET['fruit'] == 'cerise') {
        echo ' Couleur du fruit: Rouge <br>';
    }else {
        echo 'Ce fruit n\'existe pas <br>';
    }
} else {
    echo 'Aucun fruit sélectionné';
}

