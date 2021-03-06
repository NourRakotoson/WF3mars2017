<?php

//--------------------------------------- TRAITEMENT ---------------------------------------
require_once('inc/init.inc.php');
$inscription = false; // variable qui permet de savoir si le membre est inscrit, pour ne pas réafficher le formulaire d'inscription

// Traitement du POST : 
if (!empty($_POST)) { // si le formulaire est posté

    //validation du formulaire :
    if (strlen($_POST['pseudo']) < 4 || strlen($_POST['pseudo']) > 20) {
        $contenu .= '<div class="bg-danger">Le pseudo doit contenir au moins 4 caractères</div>';
    }

    if (strlen($_POST['mdp']) < 4 || strlen($_POST['mdp']) > 20) {
        $contenu .= '<div class="bg-danger">Le mot de passe doit contenir au moins 4 caractères</div>';
    }

    if (strlen($_POST['nom']) < 2 || strlen($_POST['nom']) > 20) {
        $contenu .= '<div class="bg-danger">Le nom doit contenir au moins 2 caractères</div>';
    }

    if (strlen($_POST['prenom']) < 2 || strlen($_POST['prenom']) > 20) {
        $contenu .= '<div class="bg-danger">Le prénom doit contenir au moins 2 caractères</div>';
    }

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $contenu .= '<div class="bg-danger">L\'e-mail est invalide</div>';
    }
    // filter_var() permet de valider des formats de chaînes de caractères pour vérifier qu'il s'agit ici d'email (on pourrait valider une URL par exemple). 

    if ($_POST['civilite'] != 'm' && $_POST['civilite'] != 'f') {
        $contenu .= '<div class="bg-danger">La civilité est incorrecte</div>';
    }

    // Si il n'y a aucune erreur sur le formulaire, on vérifie l'unicité du pseudo avant inscription en BDD :
    if (empty($contenu)) { // si $contenu est vide, c'est qu'il n'y a pas d'erreur

        $membre = executeRequete("SELECT id_membre FROM membre WHERE pseudo = :pseudo", array(':pseudo'=>$_POST['pseudo'])); // on vérifie l'existence du pseudo

        if ($membre->rowCount() > 0){ // si il y a des lignes dans le résultat de la requête
            $contenu .= '<div class="bg-danger">Le pseudo est indisponible: veuillez en choisir un autre</div>';
        } else {
        // Si le pseudo est unique, on peut faire l'inscription en BDD:
        $_POST['mdp'] = md5($_POST['mdp']); // permet d'encrypter le mot de passe selon l'algorithme md5. Il faudra le faire aussi sur la page de connexion pour comparer 2 mots cryptés

        executeRequete("INSERT INTO membre (pseudo, mdp, nom, prenom, email, civilite, statut, date_enregistrement) VALUES (:pseudo, :mdp, :nom, :prenom, :email, :civilite, 0, NOW())", array(':pseudo' => $_POST['pseudo'], ':mdp' => $_POST['mdp'], ':nom' => $_POST['nom'], ':prenom' => $_POST['prenom'], ':email' => $_POST['email'], ':civilite' => $_POST['civilite']));

        $contenu .= '<div class="bg-success">Vous êtes inscrit. <a href="connexion.php">Cliquez ici pour vous connecter</a></div>';
        $inscription = true; // pour ne plus afficher le formulaire d'inscription
        } // fin du else de if ($membre->rowCount() > 0)

    } // fin du if (empty($contenu)) {

} // fin du if(!empty($_POST))

//--------------------------------------- AFFICHAGE ---------------------------------------
require_once('inc/haut.inc.php');
echo $contenu; // affiche les messages du site

if (!$inscription) : // si membre non inscrit ($inscription vaut FALSE), on affiche le formulaire
?>
<h3>Veuillez renseigner le formulaire pour vous inscrire</h3>
<form method="post" action="">
    <label for="pseudo">Pseudo</label><br>
    <input type="text" id="pseudo" name="pseudo" value=""><br><br>

    <label for="mdp">Mot de passe</label><br>
    <input type="password" id="mdp" name="mdp" value=""><br><br>

    <label for="nom">Nom</label><br>
    <input type="text" id="nom" name="nom" value=""><br><br>

    <label for="prenom">Prénom</label><br>
    <input type="text" id="prenom" name="prenom" value=""><br><br>

    <label for="email">Email</label><br>
    <input type="text" id="email" name="email" value=""><br><br>

    <label>Civilité</label>
    <input type="radio" id="homme" name="civilite" value="m" checked><label for="homme">Homme</label>
    <input type="radio" id="femme" name="civilite" value="f"><label for="femme">Femme</label><br><br>

    <input type="submit" name="inscription" value="S'inscrire" class="btn">

<?php
endif; // syntaxe du if avec ":" qui remplace la 1ère accolade et "endif" qui remplace la seconde

require_once('inc/bas.inc.php');