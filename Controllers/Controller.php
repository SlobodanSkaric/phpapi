<?php 

namespace MyControl\Controllers;

class Controller{
    private \PDO $dbc;

    public function __construct(\PDO $dbconection){
        $this->dbc = $dbconection;
    }

    public function getConnection(){
        return $this->dbc;
    }
}