<?php
namespace Entity;

class Article {
    /**
     *
     * @var int 
     */
    private $id;
    
    /**
     *
     * @var string 
     */
    private $title;
    
    /**
     * 
     * @return int
     */
    public function getId() 
    {
        return $this->id;
    }
    
    /**
     * 
     * @return string
     */
    public function getTitle() 
    {
        return $this->title;
    }
    
    /**
     * 
     * @param int $id
     * @return $this
     */
    public function setId(int $id) 
    {
        $this->id = $id;
        return $this;
    }
    
    /**
     * 
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title) 
    {
        $this->title = $title;
        return $this;
    }

}