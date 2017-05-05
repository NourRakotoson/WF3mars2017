<?php

/* 1- Créer une base de données "contacts" avec une table "contact" :
	  id_contact PK AI INT(3)
	  nom VARCHAR(20)
	  prenom VARCHAR(20)
	  telephone INT(10)
	  annee_rencontre (YEAR)
	  email VARCHAR(255)
	  type_contact ENUM('ami', 'famille', 'professionnel', 'autre')

	2- Créer un formulaire HTML (avec doctype...) afin d'ajouter un contact dans la bdd. Le champ année est un menu déroulant de l'année en cours à 100 ans en arrière à rebours, et le type de contact est aussi un menu déroulant.
	
	3- Effectuer les vérifications nécessaires :
	   Les champs nom et prénom contiennent 2 caractères minimum, le téléphone 10 chiffres
	   L'année de rencontre doit être une année valide
	   Le type de contact doit être conforme à la liste des types de contacts
	   L'email doit être valide
	   En cas d'erreur de saisie, afficher des messages d'erreurs au-dessus du formulaire

	3- Ajouter les contacts à la BDD et afficher un message en cas de succès ou en cas d'échec.

*/
$message = '';
$pdo = new PDO('mysql:host=localhost;dbname=contacts', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

if (!empty($_POST)) {
	//print_r($_POST);
	
	if (strlen($_POST['nom']) < 2 || strlen($_POST['nom']) > 20) $message .= '<div> Le nom doit comporter au moins 3 caractères</div>';

	if (strlen($_POST['prenom']) < 2 || strlen($_POST['prenom']) > 20) $message .= '<div> Le prénom doit comporter au moins 3 caractères</div>';

	if (!is_numeric($_POST['telephone']) || $_POST['telephone'] <= 10) $message .= '<div> Le numéro de téléphone doit être supérieur à 0</div>';

	if ($_POST['annee_rencontre'] == "1917" ) $message .= '<div> Sélectionner une année de rencontre</div>';

	if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) $message .= '<div> L\'e-mail est invalide</div>'; 

	if ($_POST['type_contact'] != 'ami' && $_POST['type_contact'] != 'famille' && $_POST['type_contact'] != 'professionnel' && $_POST['type_contact'] != 'autre' ) $message .= '<div>Le type de contact est incorrect</div>';

	if (empty($message)) {
		$resultat = $pdo->prepare("INSERT INTO contact( nom, prenom, telephone, annee_rencontre, email, type_contact) VALUES(:nom, :prenom, :telephone, :annee_rencontre, :email, :type_contact)"); 

        $resultat->bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
        $resultat->bindParam(':prenom', $_POST['prenom'], PDO::PARAM_STR);
        $resultat->bindParam(':telephone', $_POST['telephone'], PDO::PARAM_INT);
        $resultat->bindParam(':annee_rencontre', $_POST['annee_rencontre'], PDO::PARAM_STR);
        $resultat->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
        $resultat->bindParam(':type_contact', $_POST['type_contact'], PDO::PARAM_STR);

        $req = $resultat->execute();

        // 4 - Afficher un message "L'employé a bien été ajouté" : 
        if ($req) { // execute() ci-dessus renvoie TRUE en cas de succès de la requête, sinon FALSE
            echo 'Le contact a bien été ajouté';
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
		<title>Ajout Contact</title>
	</head>

	<body>
		<form method="post" action="">
    	<?php echo $message; ?>

		<label for="nom">Nom</label><br>
		<input type="text" id="nom" name="nom" value=""><br><br>

		<label for="prenom">Prénom</label><br>
		<input type="text" id="prenom" name="prenom" value=""><br><br>

		<label for="telephone">Numéro de téléphone</label><br>
		<input type="tel" id="telephone" name="telephone" value=""><br><br>
		
		<label for="annee_rencontre">Année de rencontre</label><br>
		<select id="annee_rencontre" name="annee_rencontre">
		<?php	
			$annee = 0;
			while ($annee < 100) {
				// on fait une boucle pour les colonnes:
				for ($option = 1917; $option <= 2017; $option++){
				echo "<option>$option</option>";		
				}
				$annee++;		
		}
		?>
		</select><br>

		<br><label for="email">Email</label><br>
		<input type="text" id="email" name="email" value=""><br><br>

		<label for="type_contact">Type de contact</label><br>
		<select name="type_contact">
			<option value="default">Default</option>
			<option value="ami" <?php if(isset($_POST['type_contact']) && $_POST['type_contact'] == 'ami') echo 'selected'; ?>>Ami</option>
			<option value="famille" <?php if(isset($_POST['type_contact']) && $_POST['type_contact'] == 'famille') echo 'selected'; ?>>Famille</option>
			<option value="professionnel" <?php if(isset($_POST['type_contact']) && $_POST['type_contact'] == 'professionnel') echo 'selected'; ?>>Professionnel</option>
			<option value="autre" <?php if(isset($_POST['type_contact']) && $_POST['type_contact'] == 'autre') echo 'selected'; ?>>Autre</option>			
		</select><br>

    	<br><input type="submit" name="inscription" value="S'inscrire" class="btn">
		
	</body>
</html>

