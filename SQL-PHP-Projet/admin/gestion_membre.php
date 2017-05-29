<?php
require_once('../inc/init.inc.php');

//--------------------------------------- TRAITEMENT ---------------------------------------
// 1 - vérification ADMIN
if (!internauteEstConnecteEtEstAdmin()){
        header('location:../connexion.php'); // si le membre n'est pas admin, alors on le redirige vers la page de connexion qui est à la racine du site (en dehors du dossier admin)
        exit();
}

// 7 - Suppression d'un produit
if (isset($_GET['action']) && $_GET['action'] == 'suppression' && isset ($_GET['id_membre'])) {

    // On sélectionne en base la photo pour pouvoir supprimer le fichier photo correspondant : 
    $resultat = executeRequete("SELECT photo FROM membre WHERE id_membre = :id_membre", array(':id_membre' => $_GET['id_membre']));

    $membre_a_supprimer = $resultat->fetch(PDO::FETCH_ASSOC); // pas de boucle while car un seul membre

    // Puis suppression du membre en BDD : 
    executeRequete("DELETE FROM membre WHERE id_membre = :id_membre", array(':id_membre' => $_GET['id_membre']));

    $contenu .= '<div class="bg-success">Le membre a été supprimé ! </div>';
    $_GET['action'] = 'affichage'; // pour lancer l'affichage des membres dans le tableau HTML (point 6)
}

// 4 - Enregistrement du membre en BDD
if ($_POST) {

    executeRequete("REPLACE INTO membre (id_membre, pseudo, mdp, nom, prenom, email, civilite, statut, date_enregistrement) VALUES (:id_membre, :pseudo, :mdp, :nom, :prenom, :email, :civilite, 0,  NOW())", array('id_membre' => $_POST['id_membre'], 'pseudo' => $_POST['pseudo'], 'mdp' => $_POST['mdp'], 'nom' => $_POST['nom'], 'prenom' => $_POST['prenom'], 'email' => $_POST['email'], 'civilite' => $_POST['civilite']));

    $contenu .= '<div class="bg-success">Le membre a été enregistré</div>';
    $_GET['action'] = 'affichage';
}


// 2 - Les liens "affichage" et "ajout d'un membre"
$contenu .= '<ul class="nav nav-tabs">
                <li><a href="?action=affichage">Affichage des membres</a></li>
                <li><a href="?action=ajout">Ajout d\'un membre</a></li>              
            </ul>';

// 6 - Affichage des membres dans le back-office : 
if (isset($_GET['action']) && $_GET['action'] == 'affichage' || !isset($_GET['action'])) { // si $_GET contient affichage ou que l'on arrive sur la page la 1ere fois ($_GET['action'] n'existe pas)
    $resultat = executeRequete(
    "SELECT * FROM membre"); 

    $contenu .= '<h3>Affichage des membres</h3>';
    $contenu .= '<p>Nombre de membre(s) : ' . $resultat->rowCount() . '</p>';

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
                                <a href="?action=modification&id_membre='. $ligne['id_membre'] . '">Modifier</a> /
                                <a href="?action=suppression&id_membre='. $ligne['id_membre'] . '" onclick="return(confirm(\'Etes-vous certain de vouloir supprimer ce membre ? \')) ;">Supprimer</a>
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
// Si on a demandé l'ajout d'un membre ou sa modification, on affiche le formulaire :

    // 8 - Formulaire de modification avec présaisie des infos dans le formulaire : 
    if (isset($_GET['id_membre'])) {
        // Pour préremplir le formulaire, on requête en BDD les infos du membre passé dans l'URL :
        $resultat = executeRequete("SELECT * FROM membre WHERE id_membre = :id_membre", array(':id_membre' => $_GET['id_membre']));


        $membre_actuel = $resultat->fetch(PDO::FETCH_ASSOC); // pas de while car qu'un seul membre
    }
?>
<h3>Formulaire d'ajout ou de modification d'un membre</h3>
<form method="post" enctype="multipart/form-data" action=""> <!-- "multipart/form-data" permet d'uploader un fichier et de générer une superglobale $_FILES -->
    <input type="hidden" id="id_membre" name="id_membre" value="<?php echo $membre_actuel['id_membre'] ?? 0; ?>"><br><br> <!-- champ caché qui réceptionne l'id_membre nécessaire lors de la modification d'un membre existant -->

    <h3>Veuillez renseigner le formulaire inscrire</h3>
        <form method="post" action="">
            <label for="pseudo">Pseudo</label><br>
            <input type="text" id="pseudo" name="pseudo" value=""><br><br>

            <label for="mdp">Mot de passe</label><br>
            <input type="password" id="mdp" name="mdp" value=""><br><br>

            <label for="nom">Nom</label><br>
            <input type="text" id="nom" name="nom" value=""><br><br>

            <label for="prenom">Prénom</label><br>
            <input type="text" id="prenom" name="prenom" value=""><br><br>

            <label for="email">Email</label><br>
            <input type="text" id="email" name="email" value=""><br><br>

            <label>Civilité</label>
            <input type="radio" id="homme" name="civilite" value="m" checked><label for="homme">Homme</label>
            <input type="radio" id="femme" name="civilite" value="f"><label for="femme">Femme</label><br><br>

            <input type="submit" name="inscription" value="S'inscrire" class="btn">
            
        </form>


<?php
endif;
require_once('../inc/bas.inc.php');