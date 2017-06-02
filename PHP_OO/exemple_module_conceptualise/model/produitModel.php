<?php

require __DIR__ . '/Model.php';

class ProduitsModel extends Model
{
	public function getAllProduits(){
		$requete = "SELECT * FROM produits";
	
	
	}
	
	public function getProduitById($id){
		$requete = "SELECT * FROM produits WHERE id_produit = :id";
		
		
	}
	
	
	
	
}