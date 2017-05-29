<style>p{font-size: 15px; color:red; font-weight: bold;}</style>
<?php
$contenu = '';
$languages = array('français', 'anglais', 'espagnol', 'autre');
$categories = array('comedie', 'drame', 'science-fiction', 'autre');

//--------------------------------------- TRAITEMENT ---------------------------------------
// Connexion à la BDD
$pdo = new PDO('mysql:host=localhost;dbname=exercice_3', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

//var_dump($_POST); Vérification de ce que contient $_POST

// Traitement du POST : effectuer les vérifications nécessaires
if(!empty($_POST)){ // si le formulaire est posté

	if (strlen($_POST['title']) < 5 || strlen($_POST['title']) > 30){
		$contenu .= '<p>Le titre doit comporter au moins 5 caractères</p>';
	}

	if (strlen($_POST['actors']) < 5 || strlen($_POST['actors']) > 60){
		$contenu .= '<p>Le nom des acteurs doit comporter au moins 5 caractères</p>';
	}

	if (strlen($_POST['director']) < 5 || strlen($_POST['director']) > 30){
		$contenu .= '<p>Le nom du réalisateur doit comporter au moins 5 caractères</p>';
	}

	if (strlen($_POST['producer']) < 5 || strlen($_POST['producer']) > 30){
		$contenu .= '<p>Le nom du producteur doit comporter au moins 5 caractères</p>';
	}

	if (!(is_numeric($_POST['year_of_prod']) && date('Y', $_POST['year_of_prod']))){
		$contenu .= '<p>L\'année de sortie du film n\'est pas valide</p>';
	}

	if (!in_array($_POST['language'], $languages)){
		$contenu .= '<p>La langue n\'est pas valide</p>';
	}

	if (!in_array($_POST['category'], $categories)){
		$contenu .= '<p>La catégorie n\'est pas valide</p>';
	}

	if (strlen($_POST['storyline']) < 5 || strlen($_POST['storyline']) > 200) {
        $contenu .= '<p>Le résumé doit contenir au moins 5 caractères</p>';
    }

	if (!filter_var($_POST['video'], FILTER_VALIDATE_URL)){
		$contenu .= '<p>L\'URL n\'est pas valide</p>';
	}
	
	// Si $contenu est vide, il n'y a aucune erreur sur le formulaire,
	if (empty($contenu)) {

		foreach($_POST as $indice => $valeur)
		{
			$_POST[$indice] = htmlspecialchars($valeur, ENT_QUOTES);
		}

		$query = $pdo->prepare('INSERT INTO movies (title, actors, director, producer, year_of_prod, language, category, storyline, video) VALUES(:title, :actors, :director, :producer, :year_of_prod, :language, :category, :storyline, :video)');
		$query->bindParam(':title', $_POST['title'], PDO::PARAM_STR);
		$query->bindParam(':actors', $_POST['actors'], PDO::PARAM_STR);
		$query->bindParam(':director', $_POST['director'], PDO::PARAM_STR);
		$query->bindParam(':producer', $_POST['producer'], PDO::PARAM_STR);
		$query->bindParam(':year_of_prod', $_POST['year_of_prod'], PDO::PARAM_INT);
		$query->bindParam(':language', $_POST['language'], PDO::PARAM_STR);
		$query->bindParam(':category', $_POST['category'], PDO::PARAM_STR);
		$query->bindParam(':storyline', $_POST['storyline'], PDO::PARAM_INT);
		$query->bindParam(':video', $_POST['video'], PDO::PARAM_STR);

		$succes = $query->execute();

		if ($succes) {
			$contenu .= '<div>Le film a été enregistré avec succès<div>';
		} else {
			$contenu .= '<div>Erreur lors de l\'enregistrement<div>';
		}

	} // fin du if (empty($contenu)) 

} // fin du if(!empty($_POST))

//--------------------------------------- AFFICHAGE ---------------------------------------
// Créer un formulaire permettant d’ajouter un film 
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ajouter un film</title>
</head>
<body>

	<h1>Ajouter une fiche pour un film</h1>

	<?php  echo $contenu; ?> <!--affiche les messages d'erreur du site-->

	<form method="post" action="">
		
		<div>
			<label for="title">Titre</label>
			<input type="text" name="title" id="title">
		</div>

		<div>
			<label for="actors ">Acteurs</label>
			<textarea name="actors" id="actors"></textarea>
		</div>

		<div>
			<label for="director">Réalisateur</label>
			<input type="text" name="director" id="director">
		</div>

		<div>
			<label for="producer">Producteur</label>
			<input type="text" name="producer" id="producer">
		</div>

		<div>
			<label>Année</label>
			<select name="year_of_prod">
				<?php 
				for($i = 1891; $i <= 2017; $i++){
					echo "<option value=$i>$i</option>";
				} 
				?>
			</select>
		</div>

		<div>
			<label for="language">Langue</label>
	
			<select name="language" id="language">
				<?php 
				foreach($languages as $key => $value){
					echo "<option value=$value>$value</option>";
				} 
				?>
				
			</select>
		</div>

		<div>
			<label for="category">Catégorie</label>
	
			<select name="category" id="category">
				<?php 
				foreach($categories as $key => $value){
					echo "<option value=$value>$value</option>";
				} 
				?>
				
			</select>
		</div>

		<div>
			<label for="storyline ">Résumé</label>
			<textarea name="storyline" id="storyline"></textarea>
		</div>

		<div>
			<label for="video ">Lien bande-annonce</label>
			<input type="video" name="video" id="video"></textarea>
		</div>

		<button type="submit">Envoyer</button>

	</form>


</body>
</html>