<?php
require_once('inc/init.inc.php');

//-------------------------TRAITEMENT-----------------------

// 1- Affichage des catégories de salle :
    $villes_des_salles = executeRequete("SELECT salle.*, produit.* FROM salle INNER JOIN produit ON salle.id_salle=produit.id_salle GROUP BY salle.ville");
    
    $categories_des_salles = executeRequete("SELECT salle.*, produit.* FROM salle INNER JOIN produit ON salle.id_salle=produit.id_salle GROUP BY salle.categories");

    
    $contenu_gauche.= '<p class="lead">Salles</p>';
    $contenu_gauche.= '<div class="list-group">';
        $contenu_gauche .= '<a href="?ville=all" class="list-group-item" > Toutes les villes</a>';
        //Boucle while qui parcout l'objet $villes_des_salles pour en faire un array associatif :
        while($ville=$villes_des_salles->fetch(PDO::FETCH_ASSOC)){
           $contenu_gauche.= '<a href="?ville='.$ville['ville'].'" class="list-group-item">'. $ville['ville'].'</a>';
        }
    $contenu_gauche.= '</div>';

      $contenu_gauche.= '<p class="lead">Catégories</p>';
    $contenu_gauche.= '<div class="list-group">';
        $contenu_gauche .= '<a href="?categories=all" class="list-group-item" > Toutes les categories</a>';
        //Boucle while qui parcout l'objet $categories_des_salles pour en faire un array associatif :
        while($categories=$categories_des_salles->fetch(PDO::FETCH_ASSOC)){
           $contenu_gauche.= '<a href="?categories='.$categories['categories'].'" class="list-group-item">'. $categories['categories'].'</a>';
        }
    $contenu_gauche.= '</div>';

// 2- Affichage des salles selon la navigation_catégorie choisie :
    if(isset($_GET['ville']) && $_GET['ville'] !='all'){
        // si on a choisi une catégorie autre que all :
        $donnees = executeRequete("SELECT produit.*, salle.* FROM produit INNER JOIN salle ON produit.id_salle = salle.id_salle  WHERE ville = :ville",array(':ville'=>$_GET['ville']));
    }else{
        // sinon si on a demander toutes les catégories :
        $donnees=executeRequete("SELECT produit.*, salle.* FROM produit INNER JOIN salle ON produit.id_salle = salle.id_salle"); 

        if(isset($_GET['categories']) && $_GET['categories'] !='all'){
            // si on a choisi une catégorie autre que all :
            $donnees = executeRequete("SELECT produit.*, salle.* FROM produit INNER JOIN salle ON produit.id_salle = salle.id_salle  WHERE categories = :categories",array(':categories'=>$_GET['categories']));
        }else{
            // sinon si on a demander toutes les catégories :
            $donnees=executeRequete("SELECT produit.*, salle.* FROM produit INNER JOIN salle ON produit.id_salle = salle.id_salle"); 
        }
    }


    while($produit=$donnees->fetch(PDO::FETCH_ASSOC)){
        $contenu_droite.= '<div class="col-sm-4 col-lg-4 col-md-4">';
            $contenu_droite.= '<div class="thumbnail ">';
                $contenu_droite .= '<a href="fiche_produit.php?id_produit='.$produit['id_produit'].'"><img src="'.$produit['photo'].'" width="130" height="100"></a>';
                $contenu_droite.= '<div class="caption">';
                    $contenu_droite.= '<h4 class="pull-right" >'. '<strong>' . $produit['prix'] . ' </strong> ' . '€</h4>';
                    $contenu_droite.= '<h4>'.$produit['titre'].'</h4>';
                    $contenu_droite.= '<p>'.substr($produit['description'],0,60).' ...</p>';
                    $contenu_droite.= '<p> Du '.$produit['date_arrivee']. ' au ' . $produit['date_arrivee'] .'</p>';                   
                $contenu_droite.= '</div>';
                $contenu_droite.= ' <div class="ratings">
                        <p class="pull-right">15 reviews</p>
                        <p>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                        </p>
                    </div>';
            $contenu_droite.= '</div>';
            
        $contenu_droite.= '</div>';
    }

//-------------------------AFFICHAGE-----------------------
require_once('inc/haut.inc.php');
?>

<div class="row">
    <div class="col-md-3">
        <?php echo $contenu_gauche; ?>
    </div>

    <div class="col-md-9">
        <div class="row">
            <?php echo $contenu_droite; ?>
         </div>
    </div>
</div>