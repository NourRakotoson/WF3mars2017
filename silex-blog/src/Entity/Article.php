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
     * @var string
     */
    private $content;
    
    /**
     *
     * @var string 
     */
    private $shortContent;
    
    /**
     *
     * @var Category
     */
    private $category;
    
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
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
    
    /**
     * 
     * @return string
     */
    public function getShortContent() 
    {
        return $this->shortContent;
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
    
    /**
     * 
     * @param string $content
     * @return $this
     */
    public function setContent($content) 
    {
        $this->content = $content;
        return $this;
    }
    
    /**
     * 
     * @param string $shortContent
     * @return $this
     */
    public function setShortContent($shortContent) 
    {
        $this->shortContent = $shortContent;
        return $this;
    }
    
    /**
     * 
     * @return \Entity\Category
     */
    public function getCategory() 
    {
        return $this->category;
    }
    
    /**
     * 
     * @param \Entity\Category $category
     * @return $this
     */
    public function setCategory(Category $category) {
        
        $this->category = $category;
        
        return $this;
    }
    
    /**
     * 
     * @return int|null
     */
    public function getCategoryId()
    {
        if (!is_null($this->category)) {
            return $this->category->getId();
        }
        
        return null;
    }
    
    /**
     * 
     * @return string
     */
    public function getCategoryName()
    {
        if (!is_null($this->category)) {
            return $this->category->getName();
        }
        
        return '';
    }


}