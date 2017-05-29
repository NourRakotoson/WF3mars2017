<?php
require_once('inc/init.inc.php');

//-------------------------TRAITEMENT-----------------------

$aside='';




// 1- Contrôle de l'existence du produit demandé :
    if(isset($_GET['id_produit'])){     // si existe l'indice id_produit dans url
        // On requête en base le produit demandé pour vérifier son existence :
        $resultat = executeRequete("SELECT salle.*, produit.* FROM salle INNER JOIN produit ON salle.id_salle = produit.id_salle WHERE id_produit = :id_produit", array(':id_produit'=>$_GET['id_produit']));

        if($resultat->rowCount()<=0){
            header('location:boutique.php'); //si il n'y a pas de résultat dans la requête, c'est que le produit n'existe pas : on oriente alors vers la boutque
            exit();
        }

    // 2- Affichage du détail du produit :
        $produit = $resultat->fetch(PDO:: FETCH_ASSOC); // Pas de while car qu'un seul produit

        $contenu.= '<div class="row">
                         <div class="col-lg-12">
                            <h1 class="page-header">'.$produit['titre'].'</h1>
                        </div>
                    </div>';
        
        $contenu .= '<div class="col-md-12">
                            <img clas="img-responsive" src="'.$produit['photo'].'" alt="">
                     </div>';

        $contenu.= '<div class="col-md-4">
                        <h3>Description</h3>
                        <p>'.$produit['description'].'</p>

                        <h3>Détails</h3>
                        <ul>
                            <li>Date d\'arrivée : '.$produit['date_arrivee'] .'</li>
                            <li>Date du départ : '.$produit['date_depart'] .'</li>
                        </ul>

                        <p class="lead">Prix :'.$produit['prix'].'€ </p>

                        <a href="avis.php?id_salle='.$produit['id_salle'].'"> Ajouter un commentaire !</a>
                    </div>'; 

    // 3- Affichage du formulaire d'ajout au panier si stock supérieur à zéro:
        $contenu.='<div class="col-md-4">';
            if($produit['etat'] == 'libre'){
                //si elle est libre on met le bouton d'ajout au panier
                 $contenu.='<form action="" method="post">';
                    $contenu.= '<input type="hidden" name="id_produit" value="'.$produit['id_produit'].'" >';
                    $contenu.= '<br><br><input type="submit" name="reserver" value="reserver" style="margin-left:10px" class="btn"><br>';

                $contenu.='</form>';
            } else{
                $contenu.='<p>Cette salle n\'est plus diponible à ces dates</p>';
            }

        // 4- Lien retour vers la boutique :
            $contenu.= '<br><p><a href="boutique.php?categories='.$produit['categories'].'">Retour vers votre sélection</a></p>';
        $contenu.= '</div>';

            } else{
                // si l'indice id_produit n'est pas dans l'url
                header('location:boutique.php');
                exit();
            }
// Creation d'un lien qui envoie sur une autre page pour remplir le formulaire '

//***********************************************

//5- Affichage des suggestions produits :

 $suggestion = executeRequete("SELECT salle.*, produit.* FROM salle INNER JOIN produit ON salle.id_salle = produit.id_salle WHERE ville = :ville AND id_produit != :id_produit ORDER BY RAND() LIMIT 3 ", array('id_produit'=>$produit['id_produit'], ':ville'=> $produit['ville'] ));

while ($produit_suggere= $suggestion->fetch(PDO::FETCH_ASSOC)){   
        $aside.= '<div class="row">
                            <div class="col-lg-12">
                                <h3 class="page-header">'.$produit_suggere['titre'].'</h3>
                            </div>
                        </div>';

        $aside .= '<div class="col-sm-3">';
           $aside .= '<a href="fiche_produit.php?id_produit='.$produit_suggere['id_produit'].'"><img clas="img-responsive" src="'.$produit_suggere['photo'].'" alt="" width="100px" > </a>';
        $aside .=' </div>'; 
}



//-------------------------AFFICHAGE-----------------------
require_once('inc/haut.inc.php');
echo $contenu_gauche;  // Le contenu gauche recevra le POP-UP de confirmation d'ajout au panier. 
?>

    <div class="row">
        <?php echo $contenu;  // Le echo contenu affiche le détail d'un produit ?>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Suggestions d'autres salles</h3>
        </div>
        <?php echo $aside;  // Affiche le produit suggérés  ?>
    </div>




<?php
require_once('inc/bas.inc.php');
?>
