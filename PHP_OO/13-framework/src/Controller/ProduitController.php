<?php
//src/Controller/ProduitController.php

namespace Controller; 

use Controller\Controller;

class ProduitController extends Controller
{

	public function afficheAll(){
		$produits = $this -> getRepository() -> getAllProduits();
		$categories = $this -> getRepository() -> getAllCategories();
		
		$params= array(
			'produits' => $produits,
			'categories' => $categories,
			'title' => 'Boutique de mon site'
		);		
		
		return $this -> render('layout.html', 'boutique.html', $params);
	}
	
	public function affiche($id){
		$produit = $this -> getRepository() -> getProduitById($id);
		$suggestions = $this -> getRepository() -> getAllSuggestions($produit['categorie'], $produit['id_produit']); 
		
		$params = array(
			'produit' => $produit,
			'suggestions' => $suggestions,
			'title' => 'Fiche produit - ' . $produit['titre'] 
		);
		return $this -> render('layout.html', 'fiche_produit.html', $params);
	}

	public function categorie($categorie){
		$produits = $this -> getRepository() -> getAllProduitsByCategorie($categorie);
		$categories = $this -> getRepository() -> getAllCategories();
		
		$params = array(
			'produits' => $produits,
			'categories' => $categories,
			'title' => 'Catégorie ' . $categorie
		);
		return $this -> render('layout.html', 'categorie.html', $params);
	}

}