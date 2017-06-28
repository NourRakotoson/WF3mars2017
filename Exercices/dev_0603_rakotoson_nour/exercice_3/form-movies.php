<?php

	require_once 'inc/connect.php'; // Récupération de $pdo (Instance de PDO)
	require_once 'inc/functions.php';

	// Récupération de tous les films
	$movies = getAllMovies($pdo);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Ciné Phil</title>
	<link rel="stylesheet" href="assets/styles.css">
</head>
<body>
	<section id="list-movies">
		<ul>
		<?php foreach($movies as $movie) : ?>
			<li>
				<form action="#" method="POST">
					<button type="submit" name="add-view" value="<?= $movie['id'] ?>">Ajouter une vue</button>
					<?= $movie['title'] ?> (<i><?= $movie['genre_name'] ?></i>)
				</form>
			</li>
		<?php endforeach ?>
		</ul>
	</section>
	<section id="table-movies">
		
		<!-- Tableau de statistiques -->
		<?php 
			$resultat = $pdo->query("SELECT title, release_date, nb_viewers FROM movies ORDER BY nb_viewers DESC, release_date DESC");
			
			echo '<table border="1" bgcolor="silver" cellpadding="3" cellspacing="0">';
				
					while($movies = $resultat->fetch(PDO::FETCH_ASSOC)) {
					echo '<tr>';	
							echo '<th>' . $movies['title'] . '</th>';
							echo '<th>' . $movies['release_date'] . '</th>';
							echo '<th>' . $movies['nb_viewers'] . '</th>';
					echo '<tr>';	
					}
			echo '</table>';


		?>
	</section>

</body>
</html>


