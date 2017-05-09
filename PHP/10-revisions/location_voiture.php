<?php
/*
   1- Vous créez un formulaire avec un menu déroulant avec les catégories A,B,C et D de véhicules de location et un champ nombre de jours de location. Lorsque le formulaire est soumis, vous affichez "La location de votre véhicule sera de X euros pour Y jour(s)." sous le formulaire.

   2- Vous validez le formulaire : la catégorie doit être correcte et le nombre de jours un entier positif.

   3- Vous créez une fonction prixLoc qui retourne le prix total de la location en fonction du prix de la catégorie choisie (A : 30€, B : 50€, C : 70€, D : 90€) multiplié par le nombre de jours de location. 

   4- Si le prix de la location est supérieur à 150€, vous consentez une remise de 10%.

*/
$contenu = '';

function prixLoc($categorie, $nombre_jour_location){

    switch($categorie){
        case 'A' : $prix_jour = 15; break;
        case 'B' : $prix_jour = 20; break;
        case 'C' : $prix_jour = 25; break;
        case 'D' : $prix_jour = 30; break;
        default : return 'Catégorie inexistante';
    }

    $resultat = $nombre_jour_location * $prix_jour; 

    return 'Le véhicule ' . $categorie . ' coûtent ' . $resultat . ' euros pour ' . $nombre_jour_location . ' jours ';
}



if (!empty($_POST)) {
    //var_dump($_POST);

    if ($_POST['categorie'] != 'A' && $_POST['categorie'] != 'B' && $_POST['categorie'] != 'C' && $_POST['categorie'] != 'D'){
        $contenu .= '<div>La catégorie est incorrecte</div>';
    }

    if (!is_numeric($_POST['nombre_jour_location']) || $_POST['nombre_jour_location'] <= 0){    
        $contenu .= '<div> Le numéro de jour de location doit être supérieur à 0</div>';
    }

    if (empty($contenu)) { 
       $contenu .= prixLoc($_POST['categorie'], $_POST['nombre_jour_location']);
    }
    
}








 
?>

<h1>Formulaire Location Voitures</h1>
<form method="post">
    <label>Catégorie de véhicules</label>
    <select name="categorie">
        <option value="A" <?php if(isset($_POST['categorie']) && $_POST['categorie'] == 'A') echo 'selected'; ?>>Catégorie A</option>
        <option value="B" <?php if(isset($_POST['categorie']) && $_POST['categorie'] == 'B') echo 'selected'; ?>>Catégorie B</option>
        <option value="C" <?php if(isset($_POST['categorie']) && $_POST['categorie'] == 'C') echo 'selected'; ?>>Catégorie C</option>
        <option value="D" <?php if(isset($_POST['categorie']) && $_POST['categorie'] == 'D') echo 'selected'; ?>>Catégorie D</option>   
    </select><br>

     <input type="text" name="nombre_jour_location" placeholder="Nombre de jour de location" value="<?php echo $_POST['nombre_jour_location'] ?? ''; ?>">

    <input type="submit" value="Calculer"><br>
</form>
<?php echo $contenu; ?>



