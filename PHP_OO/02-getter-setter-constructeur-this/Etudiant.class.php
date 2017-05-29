<?php

//02-getter-setter-constructeur-this
    //-> Etudiant.class.php

class Etudiant
{
    private $prenom;

    public function __construct($prenom){ // Méthode magique qui s'exécute au moment de l'instanciation. 
        $this -> prenom = $prenom;
    }

    public function setPrenom($prenom){
        $this -> prenom = $prenom;
    }

    public function getPrenom(){
        return $this -> prenom;
    }
}

//---------------------------------------------------
$etudiant = new Etudiant('Nour');
echo 'Prénom : ' . $etudiant -> getPrenom();

// EXERCICE : Essayez d'afficher une valeur à prénom en modifiant UNIQUEMENT l'intérieur de la classe.