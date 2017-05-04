<?php
require_once('inc/init.inc.php');

//--------------------------------------- TRAITEMENT ---------------------------------------
$aside = '';

// 1 - Contrôle de l'existence du produit demandé : 
if (isset($_GET['id_produit'])) { // si existe l'indice id_produit dans l'URL
    // on requête le produit demandé pour vérifier son existence :
    $resultat = executeRequete("SELECT * FROM produit WHERE id_produit = :id_produit", array(':id_produit'=>$_GET['id_produit']));

    if ($resultat->rowCount() <= 0) {
        header('location:boutique.php'); // si il n'y a pas de résultat dans la requête, c'est que le produit n'existe pas : on réoriente alors vers la boutique
        exit();
    }

    // 2 - Affichage du détail du produit :
    $produit = $resultat->fetch(PDO::FETCH_ASSOC); // pas de while car qu'un seul produit

    $contenu .= '<div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">'. $produit['titre'] .'</h1>
                    </div>
                </div>';
    
    $contenu .= '<div class="col-md-8">
                    <img class="img-responsive" src="'. $produit['photo'] .'" alt="">
                </div>';
    
    $contenu .= '<div class="col-md-4">
                    <h3>Description</h3>
                    <p>'. $produit['description'] .'</p>
                    <h3>Détail</h3>
                    <ul>
                        <li>Catégorie : '. $produit['categorie'] .'</li>
                        <li>Couleur : '. $produit['couleur'] .'</li>                        
                        <li>Taille : '. $produit['taille'] .'</li>                                                 
                    </ul>
                    <p class="lead">Prix : '. $produit['prix'] .'€</p>

                </div>';
    
    // 3 - Affichage du formulaire d'ajout au panier si stock > 0 :
    $contenu .= '<div class="col-md-4">';
        if ($produit['stock'] > 0) {
            // s'il y a du stock, on met le bouton d'ajout au panier :
            $contenu .= '<form method="post" action="panier.php">';
                $contenu .= '<input type="hidden" name="id_produit" value="'. $produit['id_produit'] .'">';

                $contenu .= '<select name="quantite" id="quantite" class="form-group-smform-control-static">';
                    for ($i = 1; $i <= $produit['stock'] && $i <= 5; $i++) {
                        $contenu .= "<option>$i</option>"; // les quotes plutôt que les guillements permet d'éviter la concaténation avec $i
                    }
                $contenu .= '</select>';

                $contenu .= '<input type="submit" name="ajout_panier" value="ajouter au panier" class="btn" style="margin-left:10px">';
            $contenu .= '</form>';
        } else {
            $contenu .= '<p>Rupture de stock</p>';
        }

        // 4 - Lien retour vers la boutique :
        $contenu .= '<p><a href="boutique.php?categorie='. $produit['categorie'] .'">Retour vers votre sélection</a></p>';


    $contenu .= '</div>';

} else {
    // si l'indice id_produit n'est pas dans l'URL (ex:URL modifiée)
    header('location:boutique.php'); // on le redirige dans la boutique
    exit();
}   

// Affichage d'une fenêtre modale pour confirmer l'ajout au panier :
if (isset($_GET['statut_produit']) && $_GET['statut_produit'] == 'ajoute') {
    // On met dans une variable le HTML de la fenêtre modale pour l'afficher ensuite :
    $contenu_gauche = '<div class="modal fade" id="myModal" role="dialog"> 
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h4 class="modal-title">Le produit a bien été ajouté au panier</h4>
                                </div>

                                <div class="modal-body">
                                    <p><a href="panier.php">Voir le panier</a></p>
                                    <p><a href="boutique.php">Continuer ses achats</a></p>                                    
                                </div>

                            </div>
                        </div>
                    </div>';
}

//--------------------------
// Exercice
//--------------------------
/*
    Vous allez créer des suggestions de produits: afficher 2 produits (photo et titre) aléatoirement appartenant à la catégorie du produit affiché dans la page détail. 
    Ces produits doivent être différents du produit affiché. La photo est cliquable et amène à la fiche produit. 

    Utilisez la variable $aside pour afficher le contenu. 
*/
if (isset($_GET['id_produit'])) {
    $requete = executeRequete("SELECT id_produit,photo ,titre FROM produit WHERE id_produit <> :id_produit AND categorie = :categorie ORDER BY RAND() LIMIT 2", array('id_produit'=>$produit['id_produit'], 'categorie' => $produit['categorie']));    
}
while ($affichage = $requete->fetch(PDO::FETCH_ASSOC)){ 
$aside .= '<div class="col-sm-3">';
    $aside .= '<a href="fiche_produit.php?id_produit=' . $affichage['id_produit'] . '"> 
                    <img class="img-responsive" src="'. $affichage['photo'] .'"width="100%">
                    </a>';
    $aside .= '<h4>' . $affichage['titre'] .'</h4>';
    
$aside .= '</div>';
}           

//--------------------------------------- AFFICHAGE ---------------------------------------
require_once('inc/haut.inc.php');
echo $contenu_gauche; // recevra le pop up de confirmation d'ajout au panier
?>
    <div class="row">
        <?php echo $contenu; // affiche le détail d'un produit ?>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Suggestions de produits</h3>
        </div>
        <?php echo $aside; // affiche les produits suggérés ?>
    </div>

    <script>
        $(document).ready(function() {
            // affiche la fenêtre modale : 
            $("#myModal").modal("show");
        });
    </script>





<?php
require_once('inc/bas.inc.php');