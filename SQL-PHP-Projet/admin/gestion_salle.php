<?php
require_once('../inc/init.inc.php');

//--------------------------------------- TRAITEMENT ---------------------------------------
// 1 - vérification ADMIN
if (!internauteEstConnecteEtEstAdmin()){
        header('location:../connexion.php'); // si le membre n'est pas admin, alors on le redirige vers la page de connexion qui est à la racine du site (en dehors du dossier admin)
        exit();
}

// 7 - Suppression d'une salle
if (isset($_GET['action']) && $_GET['action'] == 'suppression' && isset ($_GET['id_salle'])) {

    // On sélectionne en base la photo pour pouvoir supprimer le fichier photo correspondant : 
    $resultat = executeRequete("SELECT photo FROM salle WHERE id_salle = :id_salle", array(':id_salle' => $_GET['id_salle']));

    $salle_a_supprimer = $resultat->fetch(PDO::FETCH_ASSOC); // pas de boucle while car un seul salle

    $chemin_photo_a_supprimer = $_SERVER['DOCUMENT_ROOT'] . $salle_a_supprimer['photo']; // chemin du fichier à supprimer

    if (!empty($salle_a_supprimer['photo']) && file_exists($chemin_photo_a_supprimer)) {
        // si il y a un chemin de photo en base ET que le fichier existe (file_exists est une fonction prédéfinie), on peut le supprimer :
        unlink($chemin_photo_a_supprimer); // supprime le fichier spécifié
    }

    // Puis suppression du salle en BDD : 
    executeRequete("DELETE FROM salle WHERE id_salle = :id_salle", array(':id_salle' => $_GET['id_salle']));

    $contenu .= '<div class="bg-success">La salle a été supprimée ! </div>';
    $_GET['action'] = 'affichage'; // pour lancer l'affichage des salles dans le tableau HTML (point 6)

}

// 4 - Enregistrement du salle en BDD
if ($_POST) { // équivalent à !empty($_POST) car si $_POST est rempli, il vaut TRUE = formulaire posté (on rentre dans la condition)

    // ici il faudrait mettre les contrôle sur le formulaire

    $photo_bdd = ''; // La photo subit un traitement spécifique en BDD. Cette variable contiendra son chemin d'accès

    // 9 - Modification de la photo (suite) :
    if (isset($_GET['action']) && $_GET['action'] == 'modification') {
        // si je suis en modification, je mets en base la photo du champ hidden photo_actuelle du formulaire : 
        $photo_bdd = $_POST['photo_actuelle'];
    }

    // 5 - Traitement de la photo : 
    //echo '<pre>'; print_r($_FILES); echo '</pre>';
    if (!empty($_FILES['photo']['name'])) { // si une image a été uploadée, $_FILES est remplie

        // On constitue un nom unique pour le fichier photo : 
        $nom_photo = $_POST['titre'] . '_' . $_FILES['photo']['name'];

        // On constitue le chemin de la photo enregistrée en BDD : 
        $photo_bdd = RACINE_SITE . 'photo/' . $nom_photo; // on obtient ici le nom et le chemin de la photo depuis la racine du site

        // On constitue le chemin absolu complet de la photo depuis la racine serveur : 
        $photo_dossier = $_SERVER['DOCUMENT_ROOT'] . $photo_bdd;
        //echo '<pre>'; print_r($photo_dossier); echo '</pre>';

        // Enregistrement du fichier photo sur le serveur : 
        copy($_FILES['photo']['tmp_name'], $photo_dossier); // on copie le fichier temporaire de la photo stockée au chemin indiqué par $_FILES['photo']['tmp_name'] dans le chemin $photo_dossier de notre serveur

    }
    // 4bis - suite de l'enregistrement en BDD :
    executeRequete("REPLACE INTO salle (id_salle, titre, description, photo, pays, ville, adresse, cp, capacite, categories) VALUES (:id_salle, :titre, :description, :photo_bdd, :pays, :ville, :adresse, :cp, :capacite, :categories)", array('id_salle' => $_POST['id_salle'], 'titre' => $_POST['titre'], 'description' => $_POST['description'], ':photo_bdd' => $photo_bdd, 'pays' => $_POST['pays'], 'ville' => $_POST['ville'], 'adresse' => $_POST['adresse'], 'cp' => $_POST['cp'], 'capacite' => $_POST['capacite'],  'categories' => $_POST['categories']));

    $contenu .= '<div class="bg-success">La salle a été enregistrée</div>';
    $_GET['action'] = 'affichage'; // on met la valeur 'affichage' dans $_GET['action'] pour afficher automatiquement la table HTML des salles plus loin dans le script (point 6)
}


// 2 - Les liens "affichage" et "ajout d'un salle"
$contenu .= '<ul class="nav nav-tabs">
                <li><a href="?action=affichage">Affichage des salles</a></li>
                <li><a href="?action=ajout">Ajout d\'une salle</a></li>              
            </ul>';

// 6 - Affichage des salles dans le back-office : 
if (isset($_GET['action']) && $_GET['action'] == 'affichage' || !isset($_GET['action'])) { // si $_GET contient affichage ou que l'on arrive sur la page la 1ere fois ($_GET['action'] n'existe pas)
    $resultat = executeRequete("SELECT * FROM salle"); // on sélectionne tous les salles

    $contenu .= '<h3>Affichage des salles</h3>';
    $contenu .= '<p>Nombre de salle(s) disponibles : ' . $resultat->rowCount() . '</p>';

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
                                <a href="?action=modification&id_salle='. $ligne['id_salle'] . '"class="fa fa-pencil-square-o" aria-hidden="true">Modifier</a> /
                                <a href="?action=suppression&id_salle='. $ligne['id_salle'] . '" onclick="return(confirm(\'Etes-vous certain de vouloir supprimer ce salle ? \')) ;"class="fa fa-trash" aria-hidden="true">Supprimer</a>
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
// Si on a demandé l'ajout d'un salle ou sa modification, on affiche le formulaire :

    // 8 - Formulaire de modification avec présaisie des infos dans le formulaire : 
    if (isset($_GET['id_salle'])) {
        // Pour préremplir le formulaire, on requête en BDD les infos du salle passé dans l'URL :
        $resultat = executeRequete("SELECT * FROM salle WHERE id_salle = :id_salle", array(':id_salle' => $_GET['id_salle']));

        $salle_actuel = $resultat->fetch(PDO::FETCH_ASSOC); // pas de while car qu'un seul salle
    }
?>
<h3>Formulaire d'ajout ou de modification d'une salle</h3>
<form method="post" enctype="multipart/form-data" action=""> <!-- "multipart/form-data" permet d'uploader un fichier et de générer une superglobale $_FILES -->
    <input type="hidden" id="id_salle" name="id_salle" value="<?php echo $salle_actuel['id_salle'] ?? 0; ?>"><br><br> <!-- champ caché qui réceptionne l'id_salle nécessaire lors de la modification d'un salle existant -->

    <label for="titre">Titre</label>
    <input type="text" id="titre" name="titre" value="<?php echo $salle_actuel['titre'] ?? ''; ?>"><br><br>

    <label for="description">Description</label>
    <textarea id="description" name="description"><?php echo $salle_actuel['description'] ?? ''; ?></textarea><br><br>

     <label for="photo">Photo</label><br><br>
    <input type="file" id="photo" name="photo"><br><br> <!-- couplé avec l'attribut enctype="multipart/form-data" de la balise <form>, le type "file" permet d'uploader un fichier (ici une photo) -->

    <label>Pays</label>
    <select name="pays">
        <option value="france">France</option>
        <option value="allemagne" <?php if(isset($salle_actuel['pays']) && $salle_actuel['pays'] == 'allemagne') echo 'selected'; ?> >Allemagne</option>
        <option value="italie" <?php if(isset($salle_actuel['pays']) && $salle_actuel['pays'] == 'italie') echo 'selected'; ?> >Italie</option>
        <option value="espagne" <?php if(isset($salle_actuel['pays']) && $salle_actuel['pays'] == 'espagne') echo 'selected'; ?> >Espagne</option>   
    </select><br>

    <label>Ville</label>
    <select name="ville">
        <option value="paris">Paris</option>
        <option value="lyon" <?php if(isset($salle_actuel['ville']) && $salle_actuel['ville'] == 'lyon') echo 'selected'; ?> >Lyon</option>
        <option value="marseille" <?php if(isset($salle_actuel['ville']) && $salle_actuel['ville'] == 'marseille') echo 'selected'; ?> >Marseille</option>
        <option value="bordeaux" <?php if(isset($salle_actuel['ville']) && $salle_actuel['ville'] == 'bordeaux') echo 'selected'; ?> >Bordeaux</option>   
    </select><br>

    <label for="adresse">Adresse</label><br>
    <textarea id="adresse" name="adresse"></textarea><br><br>

    <label for="cp">Code Postal</label><br>
    <input type="text" id="cp" name="cp" value=""><br><br>

    <label for="capacite">Capacité</label><br>
    <input type="text" id="capacite" name="capacite" value="<?php echo $salle_actuel['capacite'] ?? 0; ?>"><br><br>

    <label>Catégories</label>
    <select name="categories">
        <option value="reunion">Réunion</option>
        <option value="bureau" <?php if(isset($salle_actuel['categorie']) && $salle_actuel['categorie'] == 'bureau') echo 'selected'; ?> >Bureau</option>
        <option value="formation" <?php if(isset($salle_actuel['categorie']) && $salle_actuel['categorie'] == 'L') echo 'selected'; ?> >Formation</option>
    </select><br>

    <!-- 9 - Modification de la photo -->
    <?php
        if (isset($salle_actuel['photo'])) {
            echo '<i>Vous pouvez uploader une nouvelle photo</i><br>';
            //Afficher la photo actuelle : 
            echo'<img src="'.$salle_actuel['photo'].'" width="90" height="90"><br>';
            // Mettre la chemin de la photo dans un champ caché pour l'enregistrer en base : 
            echo '<input type="hidden" name="photo_actuelle" value="'.$salle_actuel['photo'].'">';
            // ce champ renseigne le $_POST['photo_actuelle'] qui va en base quand on soumet le formulaire de modification. Si on ne remplit pas le formulaire ici, le champ photo de la base est remplacé par un vide, ce qui efface le chemin de la photo
        }

    ?>

    <input type="submit" value="Valider" class="btn">
    
</form>


<?php
endif;
require_once('../inc/bas.inc.php');