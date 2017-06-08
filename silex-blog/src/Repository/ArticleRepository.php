<?php

namespace Repository;

use Doctrine\DBAL\Connection;
use Entity\Article;

class ArticleRepository {
    /**
     *
     * @var Connection
     */
    private $db;
    
    public function __construct(Connection $db) 
    {
        $this->db = $db;
    }
    
    public function findAll()
    {
        $dbArticles = $this->db->fetchAll('SELECT * FROM article');
        $articles = [];
        
        foreach ($dbArticles as $dbArticle){
            $article = new Article();
            $article
                    ->setId($dbArticle['id'])
                    ->setTitle($dbArticle['title'])
            ;
            
            $articles[] = $article;
        }
        
        return $articles;
    }
    
    public function find($id) 
    {
        $dbArticle = $this->db->fetchAssoc(
                'SELECT * FROM article WHERE id = :id',
                [
                    ':id' => $id
                ]
        );
        
        $article = new Article();
        $article
                ->setId($dbArticle['id'])
                ->setTitle($dbArticle['title'])
        ;
        
        return $article;
    }
    
    public function insert(Article $article) 
    {
        $this->db->insert(
                'article', // nom de la table
                ['title' => $article->getTitle()] // valeurs
        );
    }
    
    public function update(Article $article) 
    {
        $this->db->update(
                'article', // nom de la table
                ['title' => $article->getTitle()], // valeurs
                ['id'=> $article->getId()] // clause WHERE
        );
    }
    
    public function save(Article $article) 
    {
        if (!empty($article->getId() )) {
            $this->update($article);
        } else {
            $this->insert($article);
        }
    }
    
    public function delete(Article $article) 
    {
        $this->db->delete(
                'article',
                ['id' =>$article->getId()]
        );
       
    }
}
