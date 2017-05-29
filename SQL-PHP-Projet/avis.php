<?php
require_once('inc/init.inc.php');
//-------------------------AFFICHAGE-----------------------
require_once('inc/haut.inc.php');
echo $contenu;


//-------------------------TRAITEMENT-----------------------
$aside='';

// 1- Contrôle de l'existence du produit :
    if(isset($_GET['id_salle'])){     // si existe l'indice id_produit dans url
        // On requête en base le produit demandé pour vérifier son existence :
        $resultat = $pdo->prepare("SELECT salle.*, produit.* FROM produit INNER JOIN salle ON produit.id_salle = salle.id_salle WHERE salle.id_salle = :id_salle");

		$resultat->bindParam(':id_salle', $_GET['id_salle'], PDO::PARAM_STR);
		
		// faire un fetch $resultat  + tester la valeur (vide ou pas )
		
		$resultat->execute();
		$salles = $resultat->fetch(PDO:: FETCH_ASSOC);
			if(empty($salles)){	
            header('location:accueil.php'); //si il n'y a pas de résultat dans la requête, c'est que le produit n'existe pas : on oriente alors vers la boutque
            exit();
        	}
        
	}




// Traitement formulaire :
$message='';
$note= array('0', '1', '2', '3', '4', '5');

// Vérification du formulaire une fois soumis :
		if(!empty($_POST)){
			//echo print_r($_POST);

			if($_POST['commentaire'] == ''){
				$message .= '<div class="bg-danger">Vous devez donner votre avis</div>';
			}

			if(!preg_match('#^[0-5]{1}$#',$_POST['note'])) {   
				$message .= '<div class="bg-danger">Vous devez donner une note compris entre 0 et 5</div>';
			}

			// Si il n'y a pas d'erreur dans le formulaire, alors :
			if(empty($message)){
				// dd($_SESSION);
				
				executeRequete("INSERT INTO avis(id_salle, id_membre , commentaire,note, date_enregistrement) VALUES ( :id_salle, :id_membre,:commentaire, :note, NOW())", array( 'id_salle' => $salles['id_salle'],'id_membre' => $_SESSION['membre']['id_membre'],'commentaire' => $_POST['commentaire'], 'note' => $_POST['note']));

				$message .= '<div class="bg-success">L\'avis a été enregistré</div>';
				$_GET['action'] = 'affichage';
			}
		} // Fin du if(!empty($_POST))


?>

<!--Formulaire du commentaire-->
<?php

// Si le membre est connecté, on affiche le formulaire de validation du panier :
	if (internauteEstConnecte()){
		//echo print_r($_SESSION['membre']);
	?>
		<h3> Laisser un commentaire et noter :</h3>
		<?php echo $message ?>
			<form method="post" action="">


				<div class="input-group">
					<label for="commentaire">Commentaire</label><br>
					<textarea type="text" name="commentaire" id="commentaire"></textarea>
				</div><br><br>
				
				<div class="input-group">
					<label for="note">Note :</label><br>
			
					<select name="note" id="note">
						<?php 
						foreach($note as $key => $value){
							echo "<option value=$value>$value</option>";
						} 
						?>
						
					</select><br><br>
				</div>


				<input type="submit" value='Ajouter'>

	</form>
	<?php
			
	}else{
		echo '<div>
					<p>
						Veuillez vous <a href="inscription.php">inscrire</a> ou vous <a href="connexion.php">connecter</a> afin de pouvoir valider votre panier
					</p>
				</div>';
	}

require_once('inc/bas.inc.php');


?>