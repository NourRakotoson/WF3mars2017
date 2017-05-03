<?php
// Exercice : créer le formulaire indiqué au tableau, récupérer les données saisies et les afficher dans la même page. 

if(! empty($_POST)){ 
    echo 'Ville : ' . $_POST['ville'] . '<br>';
    echo 'Code Postal: ' . $_POST['codePostal'] . '<br>'; // attention: les name= sont sensibles à la casse 
     echo 'Adresse : ' . $_POST['adresse'] . '<br>';
}


?>

<h1>Formulaire II </h1>
<form method="post" action="">

    <label for="ville">Ville</label>
    <input type="text" id="ville" name="ville"><br>

    <label for="codePostal">Code Postal</label>
    <input type="text" id="codePostal" name="codePostal"><br>


    <label for="adresse">Adresse</label>
    <textarea id="adresse" name="adresse"></textarea><br>

    <input type="submit" name="validation" value="Valider"><br>
</form>