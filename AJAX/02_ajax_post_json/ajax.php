<?php
// nous avons besoin d'un langage interprété côté serveur pour pouvoir communiquer
// $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : ''; méthode ternaire
$prenom = "";
if(isset($_POST['prenom']))
{
    $prenom = $_POST['prenom']; // on récupère l'argument fourni via POST
}

$tab = array(); // on prépare le tableau qui contiendra la réponse

$fichier = file_get_contents("fichier.json"); // on récupère le contenu du fichier .json 
$json = json_decode($fichier, true); // on transforme en tableau array (multidimmensionnel) représenté par la variable $json. 

foreach($json as $valeur) // a chaque tour de boucle, $valeur devient un array (pour chaque personne) avec des indices (id, prenom...)
{
    if($valeur['prenom'] == strtolower($prenom))
    {
        $tab['resultat'] = '<table border="1"><tr>';
        foreach($valeur as $informations)
        {
            $tab['resultat'] .= '<td>' . $informations . '</td>';
        }
        $tab['resultat'] .= '</tr></table>';    
    }
}

echo json_encode($tab); // la réponse