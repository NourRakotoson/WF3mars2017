<?php
//vendor/Entity/produit.php

namespace Entity;

class Produit
{
    private $id_produit;
    private $reference;
    private $categorie;
    private $titre;
    private $description;
    private $couleur;
    private $taille;
    private $public, $photo, $prix, $stock;
    
    /**
    * GETTERS
    *
    */
    public function getId_produit(){
        return $this -> id_produit;
    }

    public function getReference(){
        return $this -> reference;
    }

    public function getCategorie(){
        return $this -> categorie;
    }

    public function getTitre(){
        return $this -> titre;
    }

    public function getDescription(){
        return $this -> description;
    }

    public function getCouleur(){
        return $this -> couleur;
    }

     public function getTaille(){
        return $this -> taille;
    }

     public function getPublic(){
        return $this -> public;
    }

     public function getPhoto(){
        return $this -> photo;
    }

     public function getPrix(){
        return $this -> prix;
    }

    public function getStock(){
        return $this -> stock;
    }

    /**
    * SETTERS
    *
    */
    public function setId_produit($id_produit){
        $this -> id_produit = $id_produit;
    }

    public function setReference($ref){
        $this -> reference = $ref;
    }

    public function setCategorie($cat){
        $this -> categorie = $cat;
    }

    public function setTitre($titre){
        $this -> titre = $titre;
    }

    public function setDescription($description){
        $this -> description = $description;
    }

    public function setCouleur($couleur){
        $this -> couleur = $couleur;
    }

    public function setTaille($taille){
        $this -> taille = $taille;
    }

    public function setPublic($public){
        $this -> public = $public;
    }

    public function setPhoto($photo){
        $this -> photo = $photo;
    }

    public function setPrix($prix){
        $this -> prix = $prix;
    }

    public function setStock($stock){
        $this -> stock = $stock;
    }
}