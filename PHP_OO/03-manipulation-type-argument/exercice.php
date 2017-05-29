<?php

    // 03 - manipulation -type - argument
    // exercice.php

class Vehicule
{
    private $litreEssence; // Nombre de litres d'essence dans le véhicule
    private $reservoir; // Capacité maximum du réservoir

    public function getLitreEssence(){
        return $this -> litreEssence;
    }

    public function setLitreEssence($litre){
        $this -> litreEssence = $litre;
    }

    public function getReservoir(){
        return $this -> reservoir;
    }

    public function setReservoir($res){
        $this -> reservoir = $res;
    }
}

//---------------------------------------------------
class Pompe
{
    private $litreEssence;

    public function getlitreEssence(){ 
        return $this -> litreEssence;
    }

    public function setLitreEssence($litre){
        $this -> litreEssence = $litre;
    }

    public function donneEssence(Vehicule $v){ // $v est un argument de la classe Vehicule

        $litre_a_mettre = $v -> getReservoir() - $v -> getLitreEssence();
        // 45 = 50 - 5

        // affecter la nouvelle valeur de litreEssence à notre objet Véhicule (50)
        $v -> setLitreEssence($v -> getLitreEssence() + $litre_a_mettre);
        // affecte 50 au véhicule

        // affecter la nouvelle valeur de litreEssence à notre pompe (755)
        $this -> setLitreEssence($this -> getLitreEssence() - $litre_a_mettre);

    }
}

//---------------------------------------------------
/*
CONSIGNES : 

1- Création d'un véhicule
2- Attribuer un nombre de litre d'essence au véhicule (5L)
3- Attribuer la capacité max du réservoir du véhicule est de 50L (50)
4- Afficher le nombre de litre d'essence dans le véhicule
5- creation d'une pompe
6- Attribuer un nombre de litre d'essence à la pompe (800L)
7- Afficher le nombre de litre d'essence dans la pompe
8- La pompe donne de l'essence au véhicule et fait le plein
9- Afficher le nombre de litre d'essence dans le véhicule après ravitaillement
10- Afficher le nombre de litre d'essence dans la pompe après ravitaillement

!! Le véhicule ne peut pas recevoir plus que la capacité max de son réservoir !! 
*/

$vehicule = new Vehicule;
$vehicule -> setLitreEssence(5);
$vehicule -> setReservoir(50);


$pompe = new Pompe;
$pompe -> setLitreEssence(800);

echo 'Dans le véhicule, il y a : ' . $vehicule -> getLitreEssence() . ' litres.<br />';
echo 'Dans la pompe, il y a : ' . $pompe -> getLitreEssence() . ' litres.<hr />';

$pompe -> donneEssence($vehicule);
echo 'Après ravitaillement : <br />';
echo 'Dans le véhicule, il y a : ' . $vehicule -> getLitreEssence() . ' litres.<br />';
echo 'Dans la pompe, il y a : ' . $pompe -> getLitreEssence() . ' litres.<hr />';




