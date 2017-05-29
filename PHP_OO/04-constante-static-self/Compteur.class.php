<?php

    // 04 - constante - static - self
    // Compteur.class.php

class Compteur
{
    public $nbInstanceObjet = 0;
    public static $nbInstanceClass = 0;

    public function __construct(){
        $this -> nbInstanceObjet ++;
        self::$nbInstanceClass ++;
    }
}

//---------------------------------------------------
$c1 = new Compteur; // NbInstanceObjet = 1 // nbInstanceClass = 1
$c2 = new Compteur; // NbInstanceObjet = 1 // nbInstanceClass = 2
$c3 = new Compteur; // NbInstanceObjet = 1 // nbInstanceClass = 3
$c4 = new Compteur; // NbInstanceObjet = 1 // nbInstanceClass = 4
