<?php

//02-getter-setter-constructeur-this
    //-> Membre.class.php

class Membre
{
    private $pseudo;
    private $mdp;

    public function setPseudo($pseudo){
        if(!empty($pseudo) && is_string($pseudo)){
            $this -> pseudo = $pseudo;
        } else {
            return FALSE;
        }
    }

    public function getPseudo(){
        return $this -> pseudo;
    }


    public function setMdp($mdp){
        if(!empty($mdp) && is_string($mdp)){
            $salt = 'nour' . time();
            $salt = md5($salt);
            // on enregistre le salt dans la BDD par membre
            $mdp_a_crypter = $salt . $mdp;
            $mdp_crypte = md5($mdp_a_crypter);

            $this -> mdp = $mdp_crypte;
        } else {
            return FALSE;
        }
    }

    public function getMdp(){
        return $this -> mdp;
    }
}

//---------------------------------------------------
// EXERCICE : Au regard de cette classe, veuillez créer un membre, affecter des valeurs à pseudo et mdp et les afficher : 

$membre = new Membre;

$membre -> setPseudo('Nour');
$membre -> setMdp('MOT DE PASSE');

echo 'Pseudo : ' . $membre -> getPseudo() . '<br />';
echo 'Mot de passe : ' . $membre -> getMdp() . '<br />';