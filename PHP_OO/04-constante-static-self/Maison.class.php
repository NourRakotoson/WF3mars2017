<?php

    // 04 - constante - static - self
    // Maison.class.php

class Maison
{
    public $couleur = 'blanc';
    public static $espaceTerrain = '500m2';
    private $nbPorte = 10;
    private static $nbPiece = 7;
    const HAUTEUR = '10m';

    public function getNbPorte(){
        return $this -> nbPorte;
    }

    public static function getNbPiece(){
        return self::$nbPiece; 
    }

}

//---------------------------------------------------
echo 'Terrain : ' . Maison::$espaceTerrain . '<br/>'; // Ok, je fais appel à un élément appartenant à la classe, depuis la classe. 
// L'instanciation ligne 29 n'est pas obligatoire pour l'affichage de cette propriété. 

$maison = new Maison;

echo 'Couleur : ' . $maison -> couleur . '<br/>'; // OK, je fais appel à un élément de l'objet par l'objet
// echo 'Terrain : ' . $maison -> espaceTerrain . '<br/>'; ERREUR, je tente d'appeler un élément appartenant à la classe par l'objet. 

// echo 'Portes : ' .  $maison -> NbPorte . '<br/>'; ERREUR, je tente d'appeler une propriété private à l'extérieur de la classe. 
echo 'Portes : ' .  $maison -> getNbPorte() . '<br/>'; // OK, je fais appel à une propriété private via son getter, qui lui est public et donc accessible à l'extérieur de la classe. 

// echo 'Pieces : ' . $maison -> nbPiece . '<br/>'; ERREUR, private donc inaccessible à l'extérieur et en plus statique donc innaccessible via l'objet.
// echo 'Pieces : ' . Maison::$nbPiece . '<br/>'; ERREUR, je fais appel à une propriété statique via ma classe, mais elle est private donc inaccessible à l'extérieur de la classe. 
echo 'Pieces : ' . Maison::getNbPiece() . '<br/>'; // OK, je fais appel à un élément private via son getter static, donc par la classe. 

echo 'Hauteur : ' . Maison::HAUTEUR . '<br/>'; // OK, je fais appel à une propriété constance appartenant à la classe. 

/*
Commentaires : 
    Opérateurs : 
        - $objet ->     : permet d'accéder à un élément d'un objet à l'extérieur de la classe.
        - $this ->      : permet d'accéder à un élément appartenant à un objet à l'intérieur de la classe.
        - Class::       : permet d'accéder à un élément appartenant à une classe, à l'extérieur de la classe.
        - self::        : permet d'accéder à un élément d'une classe, à l'intérieur de la classe. 
    
    2 questions à se poser : 

        - Est-ce que l'élèment en question est statique ?
            - Si oui : 
                Suis-je à l'intérieur de la classe ?
                    si oui : self::
                    si non : Class::

            - Si non :
                Suis-je à l'intérieur de la classe ?
                    si oui : $this ->
                    si non : $objet ->
    
    static, signifie qu'un élément appartient à la classe. Pour y accéder, il faut l'appeler par la classe (Class:: ou self::)

    const, signifie qu'un élément appartient à la classe et ne sera jamais modifiable. 
*/  