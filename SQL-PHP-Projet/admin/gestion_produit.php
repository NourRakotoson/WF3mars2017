<?php
require_once('../inc/init.inc.php');

//--------------------------------------- TRAITEMENT ---------------------------------------
// 1 - vérification ADMIN
if (!internauteEstConnecteEtEstAdmin()){
        header('location:../connexion.php'); // si le membre n'est pas admin, alors on le redirige vers la page de connexion qui est à la racine du site (en dehors du dossier admin)
        exit();
}

$resultat = $pdo->query("SELECT * FROM salle");
$salles = $resultat -> fetchAll(PDO::FETCH_ASSOC);

// 7 - Suppression d'un produit
if (isset($_GET['action']) && $_GET['action'] == 'suppression' && isset ($_GET['id_produit'])) {

    // On sélectionne en base la photo pour pouvoir supprimer le fichier photo correspondant : 
    $resultat = executeRequete("SELECT photo FROM produit WHERE id_produit = :id_produit", array(':id_produit' => $_GET['id_produit']));

    $produit_a_supprimer = $resultat->fetch(PDO::FETCH_ASSOC); // pas de boucle while car un seul produit

    $chemin_photo_a_supprimer = $_SERVER['DOCUMENT_ROOT'] . $produit_a_supprimer['photo']; // chemin du fichier à supprimer

    if (!empty($produit_a_supprimer['photo']) && file_exists($chemin_photo_a_supprimer)) {
        // si il y a un chemin de photo en base ET que le fichier existe (file_exists est une fonction prédéfinie), on peut le supprimer :
        unlink($chemin_photo_a_supprimer); // supprime le fichier spécifié
    }

    // Puis suppression du produit en BDD : 
    executeRequete("DELETE FROM produit WHERE id_produit = :id_produit", array(':id_produit' => $_GET['id_produit']));

    $contenu .= '<div class="bg-success">Le produit a été supprimé ! </div>';
    $_GET['action'] = 'affichage'; // pour lancer l'affichage des produits dans le tableau HTML (point 6)

}

// 4 - Enregistrement du produit en BDD
if ($_POST) {

    executeRequete("REPLACE INTO produit (id_produit, id_salle, date_arrivee, date_depart, prix, etat) VALUES (:id_produit, :id_salle, :date_arrivee, :date_depart, :prix, :etat)", array('id_produit' => $_POST['id_produit'], 'id_salle' => $_POST['id_salle'], 'date_arrivee' => $_POST['date_arrivee'], 'date_depart' => $_POST['date_depart'], 'prix' => $_POST['prix'], 'etat' => $_POST['etat'] ));

    $contenu .= '<div class="bg-success">Le produit a été enregistré</div>';
    $_GET['action'] = 'affichage';
}


// 2 - Les liens "affichage" et "ajout d'un produit"
$contenu .= '<ul class="nav nav-tabs">
                <li><a href="?action=affichage">Affichage des produits</a></li>
                <li><a href="?action=ajout">Ajout d\'un produit</a></li>              
            </ul>';

// 6 - Affichage des produits dans le back-office : 
if (isset($_GET['action']) && $_GET['action'] == 'affichage' || !isset($_GET['action'])) { // si $_GET contient affichage ou que l'on arrive sur la page la 1ere fois ($_GET['action'] n'existe pas)
    $resultat = executeRequete(
    "SELECT produit.*, salle.id_salle, salle.photo
    FROM produit 
    INNER JOIN salle 
    ON produit.id_salle = salle.id_salle"); 

    $contenu .= '<h3>Affichage des produits</h3>';
    $contenu .= '<p>Nombre de produit(s) dans la boutique : ' . $resultat->rowCount() . '</p>';

    $contenu .= '<table class="table">';
        // La ligne des entêtes
        $contenu .= '<tr>';
            for($i = 0; $i < $resultat->columnCount(); $i++) {
                $colonne = $resultat->getColumnMeta($i);
                //echo '<pre>'; print_r($colonne); echo '</pre>';
                $contenu .= '<th>' . $colonne['name'] . '</th>'; // getColumnMeta() retourne un array contenant notamment l'indice name contenant le nom de la colonne
            }
            $contenu .= '<th>Action</th>'; // on ajoute une colonne "action"
        $contenu .= '</tr>';

        // Affichage des lignes
        while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
            $contenu .= '<tr>';
                //echo '<pre>'; print_r($ligne); echo '</pre>';
                foreach($ligne as $index => $data) { // $index réceptionne les indices, $data les valeurs
                    if ($index == 'photo') {
                        $contenu .= '<td><img src="'.$data.'" width="70" height="70"</td>';
                    } else {
                        $contenu .= '<td>' . $data . '</td>';
                    }
                }

                $contenu .= '<td>
                                <a href="?action=modification&id_produit='. $ligne['id_produit'] . '">Modifier</a> /
                                <a href="?action=suppression&id_produit='. $ligne['id_produit'] . '" onclick="return(confirm(\'Etes-vous certain de vouloir supprimer ce produit ? \')) ;">Supprimer</a>
                            </td>';

            $contenu .= '</tr>';
        }      

    $contenu .= '</table>';
}



//--------------------------------------- AFFICHAGE ---------------------------------------
require_once('../inc/haut.inc.php');
echo $contenu;
// 3 - Formulaire HTML
if (isset($_GET['action']) && ($_GET['action'] == 'ajout' || $_GET['action'] == 'modification')) :
// Si on a demandé l'ajout d'un produit ou sa modification, on affiche le formulaire :

    // 8 - Formulaire de modification avec présaisie des infos dans le formulaire : 
    if (isset($_GET['id_produit'])) {
        // Pour préremplir le formulaire, on requête en BDD les infos du produit passé dans l'URL :
        $resultat = executeRequete("SELECT * FROM produit WHERE id_produit = :id_produit", array(':id_produit' => $_GET['id_produit']));


        $produit_actuel = $resultat->fetch(PDO::FETCH_ASSOC); // pas de while car qu'un seul produit
    }
?>
<h3>Formulaire d'ajout ou de modification d'un produit</h3>
<form method="post" enctype="multipart/form-data" action=""> <!-- "multipart/form-data" permet d'uploader un fichier et de générer une superglobale $_FILES -->
    <input type="hidden" id="id_produit" name="id_produit" value="<?php echo $produit_actuel['id_produit'] ?? 0; ?>"><br><br> <!-- champ caché qui réceptionne l'id_produit nécessaire lors de la modification d'un produit existant -->

    <label for="id_salle">Salle</label>
    <select name="id_salle" id="id_salle">
        <?php foreach($salles as $key => $value){
					echo "<option value='" . $value['id_salle'] . "'>". $value['id_salle'] . ' - ' . $value['titre'] ."</option>";
				}?>
    </select><br>

    <label for="date_arrivee">Date d'arrivée</label>
    <input type="text" id="date_arrivee" name="date_arrivee" value="<?php echo $produit_actuel['date_arrivee'] ?? ''; ?>"><br><br>

    <label for="date_depart">Date de départ</label>
    <input type="text" id="date_depart" name="date_depart" value="<?php echo $produit_actuel['date_depart'] ?? ''; ?>"><br><br>

    <label for="prix">Prix</label><br>
    <input type="text" id="prix" name="prix" value="<?php echo $produit_actuel['prix'] ?? 0; ?>"><br><br>

    <label>Etat</label>
    <select name="etat">
        <option value="libre">libre</option>
        <option value="reserver" <?php if(isset($produit_actuel['etat']) && $produit_actuel['etat'] == 'reserver') echo 'selected'; ?> >reserver</option> 
    </select><br>

    <input type="submit" value="Ajouter" class="btn">
    
</form>


<?php
endif;
require_once('../inc/bas.inc.php');