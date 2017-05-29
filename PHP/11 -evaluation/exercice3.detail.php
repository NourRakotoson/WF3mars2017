<?php
//---------------------
$contenu = '';

$pdo = new PDO('mysql:host=localhost;dbname=exercice_3', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

if(isset($_GET['id_film'])){
	
	$query = $pdo->prepare('SELECT * FROM movies WHERE id_film = :id_film');
	$query->bindParam(':id_film', $_GET['id_film'], PDO::PARAM_INT);
	$query->execute();
	
	
	$film = $query->fetch(PDO::FETCH_ASSOC);

	$contenu .= '<h1>Détail du film</h1>';
	if (!empty($film)) {
		$contenu .= '<p>Nom : '. $film['title'] .'</p>';
		$contenu .= '<p>Téléphone : '. $film['actors'] .'</p>';
		$contenu .= '<p>Adresse : '. $film['director'] .'</p>';
		$contenu .= '<p>Type : '. $film['producer'] .'</p>';
		$contenu .= '<p>Note : '. $film['year_of_prod'] .'</p>';
		$contenu .= '<p>Avis : '. $film['language'] .'</p>';
		$contenu .= '<p>Avis : '. $film['category'] .'</p>';
		$contenu .= '<p>Avis : '. $film['storyline'] .'</p>';
		$contenu .= '<p>Avis : '. $film['video'] .'</p>';		


	} else {
		$contenu .= '<div>Ce film n\'existe pas</div>';
	}

}

// Créer une page affichant le détail d’un film de manière dynamique. Si le film n’existe pas, une erreur sera affichée. 
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Liste des films</title>
</head>
<body>
	<?php echo $contenu; ?>
</body>
</html>