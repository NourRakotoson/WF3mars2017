<?php
/*
    1 - Créer une fonction qui retourne la conversion d'un date FR en date US ou inversement. 
    Cette fonction prend 2 paramètres : une date (valide) et le format de conversion "US" ou "FR"

    2 - Vous validez que le paramètre de format est bien "US" ou "FR". La fonction retourne un message si ce n'est pas le cas. 
*/


function afficheDate($date, $format) { 
    // Version avec objet date:
    $objetDate = new DateTime($date);

    if ($format == 'FR') {
        return $objetDate->format('d-m-Y') . '<br>' ;  
    } else if ($format == 'US') {
        return $objetDate->format('Y-m-d') . '<br>' ;
    } else {
        return 'Le format demandé n\'est pas correct';
    }

}

echo afficheDate('05-05-2017', 'US');
echo afficheDate('2017-05-05', 'FR');
echo afficheDate('05-05-2017','PL') . '<br>';

// Autre version :
function afficheDate1($date1, $format) { 
    if ($format == 'FR') {
        return strftime('%d-%m-%Y', strtotime($date1)) . '<br>' ;  
    } elseif ($format == 'US') {
        return strftime('%Y-%m-%d', strtotime($date1)) . '<br>' ;  
    } else {
        return 'Le format demandé n\'est pas correct';
    }
}

echo afficheDate1('05-05-2017', 'US');
echo afficheDate1('2017-05-05', 'FR');
echo afficheDate1('05-05-2017','PL');