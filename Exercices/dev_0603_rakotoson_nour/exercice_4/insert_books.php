<?php

	//insère 200 livres au hasard en base de données

require 'RandomBookDataGenerator.php';
require 'BookManager.php';
require 'Book.php';


class AddBook extends Book
{
    protected $id;				
	protected $title;			
	protected $author;			
	protected $year;			
	protected $dateCreated;  

    public function __construct(){}

    public function __set($book){ 
        getRandomArrayElement()
		generateTitle()
		generateAuthor()
		generateYear()
		generateDate()

    }

    public function __get($nom){
        
    }  

    
}

//---------------------------------------------------
$book = new Book;

?>