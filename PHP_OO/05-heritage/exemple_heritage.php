<?php

// 05-heritage
    //-> exemple_heritage.php 

class Membre
{
    public $id_membre;
    public $pseudo;
    public $email;

    public function inscription(){
        return 'Je m\'inscris !';
    }

    public function connexion(){
        return 'Je me connecte !';
    }
}

//---------------------------------------------------
// Normalement on ne fait pas deux classes dans le même fichier, ici c'est pour les besoins de l'exercice

class Admin extends Membre // extends signifie "hérite de"
{
    // tout le code de Membre est ici !!
    
    public function accesBackOffice(){
        return 'J\'ai accès au backOffice';
    }
}

//---------------------------------------------------
$admin = new Admin;
echo $admin -> inscription() . '<br/>';
echo $admin -> connexion() . '<br/>';
echo $admin -> accesBackOffice() . '<br/>';

/*
Commentaires : 
    Dans notre site, un Admin est avant tout un membre, avec quelques fonctionnalités supplémentaires (accès backOffice, suppression de membres, etc...).
    Il est donc naturel que la classe Admin soit héritière (extends) de la classe Membre et qu'on ne ré-écrive pas tout le code. 

*/
