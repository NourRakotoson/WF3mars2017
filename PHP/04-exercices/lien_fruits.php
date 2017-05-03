<?php
// Exercice 
/*
    - Faire 4 liens HTML avec le nom des fruits. 
    - Quand on clique sur un lien, on affiche le prix pour 10000g de ce fruit, dans cette page lien_fruits.php. 
*/


include('fonction.inc.php');

if (isset($_GET['fruit'])) {

    echo calcul(($_GET['fruit']), 1000);
}

?>

<h1>Nos produits:</h1>

<a href="?fruit=cerises">Cerises</a>
<br>
<a href="?fruit=bananes">Bananes</a>
<br>
<a href="?fruit=pommes">Pommes</a>
<br>
<a href="?fruit=peches">Pêches</a>
<br>
