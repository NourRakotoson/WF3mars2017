<?php
namespace Entity;

class Category {
    /**
     *
     * @var int 
     */
    private $id;
    
    /**
     *
     * @var string 
     */
    private $name;
    
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
    public function getName() 
    {
        return $this->name;
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
     * @param string $name
     * @return $this
     */
    public function setName(string $name) 
    {
        $this->name = $name;
        return $this;
    }

}
