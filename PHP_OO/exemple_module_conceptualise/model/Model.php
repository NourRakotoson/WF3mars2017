<?php

require __DIR__ . '/../vendor/PDOManager.php';

class Model
{
	private $db; 
	
	public function getDb(){
		$this -> db = PDOManager::getInstance() -> getPDO(); 
		return $this -> db; 
	}
}