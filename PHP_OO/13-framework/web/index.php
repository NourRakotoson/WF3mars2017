<?php 
session_start();
require_once(__DIR__ . '/../vendor/autoload.php');


// TEST 1 : Entity Produit
// $produit = new Entity\Produit;
// $produit -> setTitre('Mon produit');
// echo $produit -> getTitre(); 

// TEST 2 : PDOManager
// $pdom = Manager\PDOManager::getInstance();
// $resultat = $pdom -> getPDO() -> query("SELECT * FROM produit");
// $produits = $resultat -> fetchAll(PDO::FETCH_ASSOC);
// echo '<pre>';
// print_r($produits);
// echo '</pre>';

// TEST 3 : EntityRepository
$er = new Manager\EntityRepository;

// $resultat = $er -> findAll();
// $resultat = $er -> find(6);
// $resultat = $er -> delete(6);

$produit = array(
    "id_produit" => NULL,
    "reference" => "short1",
    "categorie" => "short",
    "titre" => "Short Blanc",
    "prix" => "25",
    "taille" => "L",
    "stock" => "35",
    "public" => "mixte",
    "photo" => "short.jpg",
    "couleur" => "blanc",
    "description" => "coton"
);
$resultat = $er -> register($produit);


echo '<pre>';
print_r($resultat);
echo '</pre>';

