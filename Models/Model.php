<?php 

namespace MyControl\Models;

class Model{
    private object $db;

    public function __construct(\PDO $db){
        $this->db = $db;
    }

    public function getDatabase(){
        return $this->db;
    }
}