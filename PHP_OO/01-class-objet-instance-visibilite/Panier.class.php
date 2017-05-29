<?php

// 01-class-objet-instance-visibilite
    //-> Panier.class.php, la classe commencer par une majuscule (nomenclature à respecter dans le code aussi)
    // Autre exemples possibles:
        //-> classPanier.php 
        //-> PanierClass.php 

class Panier
{
    public $nbProduit; // propriété (variable)

    public function ajouterProduit(){
        // traitements de la méthode
        return 'L\'article a bien été ajouté au panier !';
    }

    protected function retirerProduit(){
        return 'L\'article a bien été retiré du panier !';
    }

    private function affichagePanier(){
        return 'Voici les produits dans le panier !';
    }

}

//---------------------------------------------------
$panier = new Panier; // Instanciation. $panier représente un objet de la classe Panier.
// en procédural $pdo = new PDO ('', '', '', array());
var_dump($panier);
var_dump(get_class_methods($panier)); // n'affiche que la méthode publique ajouterProduit()

$panier -> nbProduit = 5;
echo 'Nombre de produits : ' . $panier -> nbProduit . '</br>';

/* Comme la flèche d'affectation en PDO
 $pdo -> query();
 $pdo -> rowCount();
 $pdo -> prepare();
 $pdo -> bindParam();
 $pdo -> execute();
*/
echo '<pre>';
var_dump($panier);
echo '</ pre>';

echo 'Panier : ' . $panier -> ajouterProduit() . '</br>';
// echo 'Panier : ' . $panier -> retirerProduit() . '</br>'; // ERREUR : Impossible d'accéder à un élément protected à l'extérieur de la classe
// echo 'Panier : ' . $panier -> affichagePanier() . '</br>'; // ERREUR : Impossible d'accéder à un élément private à l'extérieur de la classe 

$panier2 = new Panier;
echo '<pre>';
var_dump($panier2);
echo '</pre>';

/*
Commentaires:
    New : Est un mot clé qui permet de créer un objet issu d'une classe (instanciation)

    On peut créer plusieurs objets d'une même classe. Et lorsqu'on affecte une valeur à une propriété d'un objet, cela n'a pas d'incidence sur les autres objets de la classe. 

    Niveaux de visibilité :
        - public : Accessible de partout ! 
        - protected : Accessible depuis la classe où l'élément a été déclaré ainsi que depuis les classes héritières. 
        - private : Accessible UNIQUEMENT depuis la classe où l'élément a été déclaré. 
*/



