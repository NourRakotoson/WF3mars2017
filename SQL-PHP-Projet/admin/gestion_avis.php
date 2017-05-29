<?php
require_once('../inc/init.inc.php'); 
//print_r($_SESSION); 

// --------------- Traitement ------------ 

// 1- vérification admin
if (!internauteEstConnecteEtEstAdmin()){
        header('location:../connexion.php');
        exit();
}

$resultat = $pdo->query("SELECT * FROM avis");
$avis = $resultat -> fetchAll(PDO::FETCH_ASSOC);


// 7- suppression d'un avis
if (isset($_GET['action']) && $_GET['action'] == 'suppression' && isset($_GET['id_avis'])) {


    $avis_a_supprimer = $resultat->fetch(PDO::FETCH_ASSOC);   // pas de while car qu'un seul produit 
    // ceci est un array car on a fait un fetch assoc, et dedans on a ce qu'on a défini au-dessus à aller chercher, cad photo

    //puis suppression de l'avis' en BDD : 
    executeRequete("DELETE FROM avis WHERE id_avis = :id_avis", array('id_avis' => $_GET['id_avis'])); 

    $contenu .= '<div class=bg-success">Le commentaire a été supprimé ! </div>'; 
    $_GET['action'] = 'affichage';   // pour lancer l'affichage des produits dans le tableau HTML (point 6)



} 

// 4- Enregistrement du membre en BDD
if ($_POST) {   // équivalent à !empty($_POST) car si le $_POST est rempli, il vaut TRUE = formulaire posté


    // 4 bis- suite de l'enregistrement en BDD : 
    executeRequete("REPLACE INTO avis (id_avis, id_membre, id_salle, commentaire, note, date_enregistrement) VALUES (:id_membre, :id_membre, :id_salle, :commentaire, :note, NOW())", array('id_avis' => $_POST['id_avis'], 'id_membre' => $_POST['id_membre'], 'id_salle' => $_POST['id_salle'], 'commentaire' => $_POST['commentaire'], 'note' => $_POST['note'])); 

    $contenu .= '<div class="bg-success">Le commentaire a été enregistré</div>'; 
    $_GET['action'] = 'affichage';  // on met la valeur 'affichage' dans $_GET['action'] pour afficher automatiquement la table HTML des produits plus loin dans le script (point 6) 

}


// 2- Les liens affichage 
$contenu .= '<ul class="nav nav-tabs">
            <li><a href="?action=affichage">Affichage des commentaires</a></li>
            </ul>'; 

// 6- Affichage des produits dans le back office : 
if (isset($_GET['action']) && $_GET['action'] == 'affichage' || !isset($_GET['action'])) {  // si $_GET contient affichage ou que l'on arrive sur la page la 1ère fois ($_GET['action'] n'existe pas. 

        $resultat = executeRequete("SELECT * FROM avis"); // on sélectionne tous les membres

        $contenu .='<h3>Affichage des commentaires</h3>'; 
        $contenu .='<p>Nombre de commentaires : ' . $resultat->rowCount() . '</p>'; 

        $contenu .= '<table class="table">';
            // la ligne des entêtes
            $contenu .='<tr>';
                for($i = 0; $i < $resultat->columnCount(); $i++) {
                    $colonne = $resultat->getColumnMeta($i); 
                    //echo '<pre>'; print_r($colonne); '</pre>'; 
                    $contenu .= '<th>' . $colonne['name'] . '</th>';  // getColumnMeta() retourne un array contenant notamment l'indice name contenant le nom de la colonne
                }

                $contenu .= '<th>Action</th>';  // on ajoute une colonne "action" 
            $contenu .='</tr>'; 
             
             // Affichage des lignes : 
             while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
                 $contenu .= '<tr>'; 
                    //echo '<pre>'; print_r($ligne); echo '</pre>'; 
                    foreach($ligne as $index => $data) {   // $index réceptionne les indices, $data les valeurs
                        if($index == 'photo'){  
                            $contenu.= '<td><img src="'.$data .'" width="70" height="70"></td>'; 
                        }else{
                             $contenu .= '<td>' . $data . '</td>'; 
                        }
                    }

                 $contenu .= '<td>
                                <a href="?action=suppression&id_avis='. $ligne['id_avis'] . '" onclick="return(confirm(\'Etes-vous certain de vouloir supprimer ce commentaire ? \')) ;"class="fa fa-trash" aria-hidden="true">Supprimer</a>
                            </td>';   

                 $contenu .='</tr>'; 
             }


        $contenu .='</table>';  

}




// --------------- Affichage ------------ 
require_once('../inc/haut.inc.php'); 
echo $contenu; 


// 3- formulaire HTML 

if (isset($_GET['action']) && ($_GET['action'] == 'ajout' || $_GET['action'] == 'modification')) :
// si on a demandé l'ajout d'une salle ou sa modification, on affiche le formulaire  : 

    // 8- Formulaire de modification avec pré-saisie des infos dans le formulaire : 
    if (isset($_GET['id_membre'])) {
        // Pour pré-remplir le formulaire, on requête en BDD les infos du produit passé dans l'URL : 
        $resultat = executeRequete("SELECT * FROM membre WHERE id_membre = :id_membre", array(':id_membre'=> $_GET['id_membre']));

        $produit_actuel = $resultat->fetch(PDO::FETCH_ASSOC);     
    }


?>


<?php
endif; 
require_once('../inc/bas.inc.php');