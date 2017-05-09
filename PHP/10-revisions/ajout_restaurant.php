<?php

/* 1- Créer une base de données "restaurants" avec une table "restaurant" :
	  id_restaurant PK AI INT(3)
	  nom VARCHAR(100)
	  adresse VARCHAR(255)
	  telephone VARCHAR(10)
	  type ENUM('gastronomique', 'brasserie', 'pizzeria', 'autre')
	  note INT(1)
	  avis TEXT

	2- Créer un formulaire HTML (avec doctype...) afin d'ajouter un restaurant dans la bdd. Les champs type et note sont des menus déroulants que vous créez avec des boucles.
	
	3- Effectuer les vérifications nécessaires :
	   Le champ nom contient 2 caractères minimum
	   Le champ adresse ne doit pas être vide
	   Le téléphone doit contenir 10 chiffres
	   Le type doit être conforme à la liste des types de la bdd
	   La note est un nombre entre 0 et 5
	   L'avis ne doit être vide
	   En cas d'erreur de saisie, afficher des messages d'erreurs au-dessus du formulaire

	4- Ajouter le restaurant à la BDD et afficher un message en cas de succès ou en cas d'échec.

*/
$pdo = new PDO('mysql:host=localhost;dbname=restaurants', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

$contenu = '';

$type= array('gastronomique', 'brasserie', 'pizzeria', 'autre');

$note= array('0','1','2','3','4','5');


if(!empty($_POST)){  

	if (strlen($_POST['nom']) < 2 || strlen($_POST['nom']) > 100){
		$contenu .= '<div>Le nom doit comporter au moins 2 caractères</div>';
 	}

 	if (empty($_POST['adresse']) || strlen($_POST['adresse']) > 255){
 		$contenu .= '<div>Le champ adresse doit être rempli</div>';
 	}

 	if (!preg_match('#^[0-9]{10}$#', $_POST['telephone'])) { 
        $contenu .= '<div>Le téléphone doit contenir 10 chiffres</div>';
    }

	if (!in_array($_POST['type'], $type)){
		$contenu .= '<div>Le type de restaurant n\'est pas valide</div>';
	}

	if (!in_array($_POST['note'], $note)){
		$contenu .= '<div>La note n\'est pas valide</div>';
	}

	if (empty($_POST['avis'])){
        $contenu .= '<div>L\'avis doit être rempli</div>';
    }

    if (empty($contenu)) { // si les messages sont vides, c'est qu'il n'y a pas d'erreurs

		foreach($_POST as $indice => $valeur)
		{
			$_POST[$indice] = htmlspecialchars($valeur, ENT_QUOTES);
		}


        $resultat = $pdo->prepare("INSERT INTO restaurant(nom, adresse, telephone, type, note, avis) VALUES(:nom, :adresse, :telephone, :type, :note, :avis)"); 

        $resultat->bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
        $resultat->bindParam(':adresse', $_POST['adresse'], PDO::PARAM_STR);
        $resultat->bindParam(':telephone', $_POST['telephone'], PDO::PARAM_STR);
        $resultat->bindParam(':type', $_POST['type'], PDO::PARAM_STR);
        $resultat->bindParam(':note', $_POST['note'], PDO::PARAM_INT);
        $resultat->bindParam(':avis', $_POST['avis'], PDO::PARAM_STR);

        $sucess = $resultat->execute();

        if ($sucess) { // execute() ci-dessus renvoie TRUE en cas de succès de la requête, sinon FALSE
            echo 'Votre avis a bien été ajouté';
        } else {
            echo 'Une erreur est survenue lors de l\'enregistrement';
        }

    } // fin du if (empty($message)) 

} // fin du if(!empty($_POST))


?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Ajout Restaurant</title>
	</head>

	<body>
	<?php  echo $contenu; ?>
	<form method="post" action="">

		<label for="nom">Nom</label><br>
		<input type="text" id="nom" name="nom" value=""><br><br>

		<label for="adresse">Adresse</label><br>
		<input type="text" id="adresse" name="adresse" value=""><br><br>

		<label for="telephone">Numéro de téléphone</label><br>
		<input type="text" id="telephone" name="telephone" value=""><br><br>

		<label for="type">Type</label>
		<select name="type" id="type">
			<?php 
			foreach($type as $key => $value){
				echo "<option value=$value>$value</option>";
			} 
			?>
		</select><br><br>

		<label for="note">Note</label><br>
		<select name="note" id="note">
			<?php 
			foreach($note as $key => $value){
				echo "<option value=$value>$value</option>";
			} 
			?>		
		</select><br><br>

		<label for="avis">Avis</label><br>
		<textarea id="avis" name="avis"></textarea><br><br>
		
		<input type="submit" value="valider">
	</form>

	</body>

</html>
