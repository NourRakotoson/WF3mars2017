<?php
require_once('inc/init.inc.php');
$tab = array();
$tab['resultat']='OK';

$mode = isset($_POST['mode']) ? $_POST['mode']: '';
$arg = isset($_POST['arg']) ? $_POST['arg']: ''; 

if($mode == 'liste_membre_connecte' && empty($arg)){


    $liste_membre = file("prenom.txt");  // file place chaque ligne dans un indice d'un tableau array représenté par $liste_membre
    foreach($liste_membre as $valeur){
        $tab['resultat'].= '<p>' . $valeur . '</p>'; 
    }
}

// Enregistrer le message posté par un utilisateur. On vérifie d'abord que le champs message n'est pas vide. 
elseif($mode == 'postMessage'){ 
    //On test s'il y a bien un message à enregistrer
    $arg = trim($arg); // trim permet d'enlever les espaces inutiles et ainsi d'eviter l'envoie d'un message avec uniquement des espaces (car l'espace est concidérer comme un caractère)

    if(!empty($arg)){  // si le message n'est pas vide. Alors on l'enregistre avec un INSERT INTO

        
        // $position = strpos($arg, ">");
        // $arg = substr($arg, $position); 
        // Les deux lignes précédantes sont à décommenter
        $arg = addslashes($arg); // met un \ devant les ' et " dans les messages pour eviter de faire planter la requete. 
        // enregistrement du message
        $pdo->query("INSERT INTO dialogue (id_membre, message, date) VALUES ($_SESSION[id_membre], '$arg', NOW()) ");
        $tab['resultat'] = "Message enregistré!";
    } 
}

elseif($mode == "message_tchat"){
    // recupérer tous les messages de la table dialogue
    // Traitement de l'objet résultat avec un while pour placer la reponse dans un $tab['resultat']. 

    $messages = $pdo->query("SELECT membre.pseudo, membre.civilite, dialogue.message FROM dialogue, membre WHERE membre.id_membre = dialogue.id_membre ORDER BY dialogue.date"); // Ici on fait une requete imbriqué

 while($message = $messages->fetch(PDO::FETCH_ASSOC)){
               if($message['civilite'] == 'm'){
                    $tab['resultat'] .= '<p class="bleu">' . ucfirst($message['pseudo']) . '>' . $message['message'] . '</p>'; // ucfirst permet de mettre en majuscule la première lettre (uppercase first)
              }else {
                    $tab['resultat'] .= '<p class="rose">' . ucfirst($message['pseudo']) . '>' . $message['message'] . '</p>'; 
                }
        }

}elseif($mode == 'liste_membre_connecte' && !empty($arg)){
    // Si $arg n'est pas vide alors on a un pseudo et nous devons le retirer du fichier prenom.txt
    $contenu = file_get_contents('prenom.txt'); // avec file_get_contents, on récupère le contenu du fichier pronom.txt dans la variable $contenu.
    $contenu = str_replace($arg,"", $contenu); // On remplace le pseudo par 'rien'. (on efface quoi)
    file_put_contents('prenom.txt', $contenu); //ici on ecrase l'ancien contenu par le nouveau, où l'on a supprimé le pseudo concerné. 

}

echo json_encode($tab);