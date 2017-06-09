<?php
namespace Repository;

use Doctrine\DBAL\Connection;

abstract class RepositoryAbstract {
    
    
    /**
     *
     * @var Connection
     */
    protected $db;
    
    public function __construct(Connection $db) 
    {
        $this->db = $db;
    }
}
