<?php

//06-surcharge-abstraction-finalisation-interface-trait
    //-> interface.php

interface Mouvement
{
    public function start(); // Dans une interface, les méthodes n'ont pas de contenu.
    public function turnRight();
    public function turnLeft();
}

class Bateau implements Mouvement // On n'utlise pas extends, mais implements dans le cadre des interfaces. 
{
    public function start(){ // OBLIGATION de définir les méthodes récupérées via l'implémentation de l'interface. 

    }
    public function turnRight(){

    }
    public function turnLeft(){

    }
}

class Avion implements Mouvement
{
    public function start(){

    }
    public function turnRight(){

    }
    public function turnLeft(){
        
    }
}

/*
Commentaires : 
    - Une interface est une liste de méthodes (sans contenu) qui permet de garantir que toutes les classes qui vont implémenter l'interface contiendront les mêmes méthodes, et ces méthodes auront le même nom (même sémantique). 
    C'est une sorte de contrat passé entre le développeur maître et les autres développeurs. Le plan de fabrication d'une classe. 

    - Une interface n'est pas instanciable. 
    - Une classe peut implémenter plusieurs interfaces. 
    - Une classe peut à la fois "extends" une autre classe et "implements" une ou plusieurs interface(s). 
    - Les méthodes d'une interface doivent forcément être "public" sinon elle nes peuvent pas être définies. 
*/