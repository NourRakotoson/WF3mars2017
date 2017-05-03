<?php

// EXERCICE : 
// Principe : créer un formulaire qui permet d'enregistrer un nouvel employé dans la base entreprise. 

/* Les étapes : 
    1 - Création du formulaire HTML
    2 - Connexion à la BDD
    3 - Lorsque le formulaire est posté, insertion des informations du formulaire en BDD. 
    Faites le avec une requête préparée. 
    4 - Afficher à la fin un message "L'employé a bien été ajouté". 
*/
$message = ''; // variable d'affichage des messages d'erreur de validation du formulaire

// 2 - Connexion à la BDD
$pdo = new PDO('mysql:host=localhost;dbname=entreprise', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

// 3 - Lorsque le formulaire est posté, insertion des informations en BDD: 
if (!empty($_POST)) { // si le formulaire est posté, il y a des indices dans $_POST, il n'est donc pas vide

    // Contrôle du formulaire : 
     if (strlen($_POST['prenom']) <3 || strlen($_POST['prenom']) > 20) $message .= '<div> Le prénom doit comporter au moins 3 caractères</div>'; // strlen indique le nombre de caractères

     if (strlen($_POST['nom']) <3 || strlen($_POST['nom']) > 20) $message .= '<div> Le nom doit comporter au moins 3 caractères</div>';

     if ($_POST['sexe'] != 'm' && $_POST['sexe'] !='f') $message .= '<div> Le sexe n\'est pas correct</div>';

     if (strlen($_POST['service']) <3 || strlen($_POST['service']) > 20) $message .= '<div> Le service doit contenur au moins 3 caractères'; 

     if (!is_numeric($_POST['salaire']) || $_POST['salaire'] <= 0) $message .= '<div> Le salaire doit être supérieur à 0</div>'; // is_numeric() teste si c'est un nombre

     $tab_date = explode('-', $_POST['date_embauche']); // met le jour, le mois et l'année dans un array pour pouvoir les passer à la fonction checkdate($mois, $jour, $annee)
     if (!(isset($tab_date[0]) && isset($tab_date[1]) && isset($tab_date[2]) && checkdate($tab_date[1], $tab_date[2], $tab_date[0]) ) ) $message .= '<div> La date n\'est pas valide</div>'; //checkdate($mois, $jour, $annee)
    
    if (empty($message)) { // si les messages sont vides, c'est qu'il n'y a pas d'erreurs
        $resultat = $pdo->prepare("INSERT INTO employes(prenom, nom, sexe, service, date_embauche, salaire) VALUES(:prenom, :nom, :sexe, :service, :date_embauche, :salaire)"); 

        $resultat->bindParam(':prenom', $_POST['prenom'], PDO::PARAM_STR);
        $resultat->bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
        $resultat->bindParam(':sexe', $_POST['sexe'], PDO::PARAM_STR);
        $resultat->bindParam(':service', $_POST['service'], PDO::PARAM_STR);
        $resultat->bindParam(':date_embauche', $_POST['date_embauche'], PDO::PARAM_STR);
        $resultat->bindParam(':salaire', $_POST['salaire'], PDO::PARAM_INT);

        $req = $resultat->execute();

        // 4 - Afficher un message "L'employé a bien été ajouté" : 
        if ($req) { // execute() ci-dessus renvoie TRUE en cas de succès de la requête, sinon FALSE
            echo 'L\'employé a bien été ajouté';
        } else {
            echo 'Une erreur est survenue lors de l\'enregistrement';
        }
    }
}


?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Exercice Formulaire</title>
    </head>
    <body>

        <h1>Enregistrer un employé</h1>
        <?php echo $message; ?>
        <form method="post" action="">
            <label for="prenom">Prénom</label><br>
            <input type="text" name="prenom" id="prenom"><br>

            <label for="nom">Nom</label><br>
            <input type="text" name="nom" id="nom"><br>

            <label=for"sexe">Sexe</label><br>
            <input type="radio" name="sexe" id="homme" value="m" checked><label for="homme">Homme</label><br>
            <input type="radio" name="sexe" id="femme" value="f" checked><label for="femme">Femme</label><br>

            <label for="service">Service</label><br>
            <input type="text" name="service" id="service"><br>

            <label for="date_embauche">Date d'embauche</label><br>
            <input type="text" name="date_embauche" id="date_embauche" placeholder= "XXX-XX-XX"><br>

            <label for="salaire">Salaire</label><br>
            <input type="text" name="salaire" id="salaire"><br>           

            <input type="submit" value="Entrée"><br>

        </form>
        
    </body>
</html>




