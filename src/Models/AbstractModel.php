<?php


namespace Plots\Models;


use PDO;

class AbstractModel
{
    private $db;

    public function __construct(PDO $db){
        $this->db = $db;
    }
}