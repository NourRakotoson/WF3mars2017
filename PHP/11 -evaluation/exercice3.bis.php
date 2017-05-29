<?php
/*
	Créer une page listant dans un tableau HTML les films présents dans la base de données.  Ce tableau ne contiendra, par film, que le nom du film, le réalisateur et l’année de production. 
 	Une colonne de ce tableau contiendra un lien ​« plus d’infos » permettant de voir la fiche d’un film dans le détail. 
 
*/

$contenu = '';

$pdo = new PDO('mysql:host=localhost;dbname=exercice_3', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));


$query = $pdo->prepare('SELECT * FROM movies');
$query->execute();
$contenu .= '<h1>Liste des films</h1>
			 <table border="1">';
		$contenu .= '<tr>
						<th>Nom du film</th>
						<th>Réalisateur</th>
						<th>Année de production</th>						
						<th>Autres infos</th>
					</tr>';

while ($movies = $query->fetch(PDO::FETCH_ASSOC)){
		$contenu .= '<tr>
						<td>'. $movies['title'] .'</td>
						<td>'. $movies['director'] .'</td>
						<td>'. $movies['year_of_prod'] .'</td>						
						<td>
							<a href="exercice3.detail.php?id_film='. $movies['id_film'] .'">Plus d\'infos</a>
						</td>
					</tr>';
	}			
			
$contenu .= '</table>';




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