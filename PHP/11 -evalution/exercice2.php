<?php 
// Créer une fonction permettant de convertir un montant en euros vers un montant en dollars américains. 
 
// Cette fonction prendra deux paramètres :  ● Le montant de type int ou float ● La devise de sortie (uniquement EUR ou USD).
 
// Si le second paramètre est “USD”, le résultat de la fonction sera, par exemple :  1 euro = 1.085965 dollars américains 
 
// Il faut effectuer les vérifications nécessaires afin de valider les paramètres. 

function convertir($montant, $devise) { 

    if ($devise == 'EUR' || $devise == 'USD' || is_numeric($devise)){
    
        if ($devise == 'EUR') {
            return $resultat = $montant * 1.085965 . '<br>' ;  
        } else if ($devise == 'USD') {
            return $resultat = $montant * 0.91907541 . '<br>' ;
        } else {
            return 'Le format demandé n\'est pas correct';
        }

    } // fin du 1er if
} // fin de la fonction

echo convertir(20, 'EUR');
echo convertir(20, 'USD');
echo convertir( 45, 'ROUPIE');


