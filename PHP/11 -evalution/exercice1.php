<?php

//Créer un tableau en PHP contenant les infos suivantes :  ● Prénom ● Nom ● Adresse ● Code Postal ● Ville ● Email ● Téléphone ● Date de naissance au format anglais (YYYY-MM-DD)

$tab = array( "Prénom" => "Nour", "Nom" => "Rakotoson", "Adresse" => "4, rue de la Prévoyance", "Ville" => "Vincennes", "Code Postal" => "94300", "Email" => "nour.rakotoson@gmail.com", "Téléphone" => "0673351121", "Date de naissance au format anglais (YYYY-MM-DD)" => "1986-11-17");
print_r($tab);

// A l’aide d’une boucle, afficher le contenu de ce tableau (clés + valeurs) dans une liste HTML. La date sera affichée au format français (DD/MM/YYYY). 
 
foreach ($tab as $info => $donnes) {
        if ( $info == "Date de naissance au format anglais (YYYY-MM-DD)") {  
           echo '<ul><li>' . $info . ' : 17-11-1986</li></ul>';  
        } else {
            echo '<ul><li>' . $info . ' : ' . $donnes . '</li></ul>';  
        }
}