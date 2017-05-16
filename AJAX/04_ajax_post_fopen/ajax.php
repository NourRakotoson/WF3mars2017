<?php

$email="";
if(isset($_POST['email']))
{
    $email = $_POST['email'];
}
// création ou ouverture d'un fichier via la fonction fopen
// en mode 'a' php créé le fichier s'il n'existe pas sinon il ne fait que l'ouvrir
// http://php.net/manual/fr/function.fopen.php

$f = fopen("email.txt", "a"); // !fopen = fclose
fwrite($f, $email . "\n"); // \n permet le retour à la ligne (retour chariot) dans un fichier(impossible de faire un <br>). Il doit être entre quotes "" sinon il sera mal interprété/ 

$tab = array();
$tab['resultat'] = '<h2>Confirmation de l\'inscription</h2>';

$liste = file("email.txt"); // la fonction file() place chaque ligne du fichier précisé en argument dans un tableau array. 

$tab['resultat'] .= '<p>Voici la liste de tous les inscrits</p>';

$tab['resultat'] .= '<ul>';
foreach($liste as $valeur)
{
    $tab['resultat'] .= '<li>' . $valeur . '</li>';
}

$tab['resultat'] .= '</ul>';

echo json_encode($tab);

