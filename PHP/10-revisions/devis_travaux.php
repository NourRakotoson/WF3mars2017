<?php
/* 
	1- Vous réalisez un formulaire "Votre devis de travaux" qui permet de saisir le montant des travaux de votre maison en HT et de choisir la date de construction de votre maison (bouton radio) : "plus de 5 ans" ou "5 ans ou moins". Ce formulaire permettra de calculer le montant TTC de vos travaux selon la période de construction de votre maison.

	2- Vous réalisez la validation du formulaire : le montant doit être en nombre positif non nul, et la période de construction conforme aux valeurs que vous aurez choisies.

	3- Vous créez une fonction montantTTC qui calcule le montant TTC à partir du montant HT donné par l'internaute et selon la période de construction : le taux de TVA est de 10% pour plus de 5 ans, et de 20% pour 5 ans ou moins. La fonction retourne le résultat du calcul.
	
	Formule de calcul d'un montant TTC :  montant TTC = montant HT * (1 + taux / 100) où taux est par exemple égale à 20.

	4- Vous affichez le résultat calculé par la fonction au-dessus du formulaire : "Le montant de vos travaux est de X euros avec une TVA à Y% incluse."

	5- Vous diffusez des codes de remises promotionnelles, dont un est 'abc' offrant 10% de remise. Ajoutez un champ au formulaire pour saisir le code de remise. Vous validez ce champ qui ne doit pas excéder 5 caractères. Puis la fonction montantTTC applique la remise (-10%) au montant total des travaux si le code de l'internaute est correcte. Vous affichez dans ce cas "Le montant de vos travaux est de X euros avec une TVA à Y% incluse, et y compris une remise de 10%.". 

*/
//------- AFFICHAGE --------
$contenu = '';
$afficheResultat = '';
//var_dump($_POST);



function prixTravaux($dureeTravaux, $montant, $codeRemise ){

		$taux = array(10, 20);
		$textRemise = '';

		if ($dureeTravaux == 'plusDeCinqAns') {
			$taux = $taux[0]; // soit 10
		} else {
			$taux = $taux[1]; // soit 20
		}

		$prixTravaux = $montant * (1 + $taux/100);

		if ($codeRemise == 'abc') {
			$montant = 0.9 * $montant; // applique 10% de réduction
			$textRemise =  ", et y compris une remise de 10%";
		}

		return "Le montant de vos travaux est $prixTravaux euros pour une TVA à $taux % incluse $textRemise.";

} // fin de la fonction prixTravaux()







if (!empty($_POST)) {  // si le formulaire est soumis

	if (!is_numeric($_POST['montant']) || $_POST['montant'] <= 0 ){
		$contenu .= '<div>Le montant ne peut pas être nul</div>';	
	}

	if ($_POST['dureeTravaux'] != 'plusDeCinqAns' && $_POST['dureeTravaux'] != 'moinsDeCinqAns') {
        $contenu .= '<div>La durée des travaux est incorrecte</div>';
    }

	if (strlen($_POST['codeRemise']) > 5){
		$contenu .= '<div>Le code de remise est incorrect</div>';
	}

	if (empty($contenu)) {

		$afficheResultat = prixTravaux($_POST['dureeTravaux'], $_POST['montant'], $_POST['codeRemise'] );		
	} // fin du if (empty($contenu))

} // fin du if (!empty($_POST))



//------- AFFICHAGE --------
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Votre devis</title>
	</head>
	<body>

		<h1>Votre devis de travaux</h1>

		<?php  echo $contenu; ?>

		<form method="post" action="">
			
			<div>
				<label for="montant">Montant des travaux HT</label>
				<input type="text" name="montant" id="montant">
			</div>

			<div>
				<label>Durée des travaux</label>
				<input type="radio" id="plusDeCinqAns" name="dureeTravaux" value="plusDeCinqAns" checked><label for="plusDeCinqAns">Plus de 5 ans</label>
				<input type="radio" id="moinsDeCinqAns" name="dureeTravaux" value="moinsDeCinqAns"><label for="moinsDeCinqAns">Moins de 5 ans</label><br><br>
			</div>

			<div>
				<label for="codeRemise">Code remise promotionnelle</label>
				<input type="text" name="codeRemise" id="codeRemise">
			</div>

			<button type="submit">Envoyer</button>

		</form>

		<?php echo $afficheResultat; ?>

	</body>
</html>

