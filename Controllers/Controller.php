<?php 

namespace MyControl\Controllers;

class Controllers{
    private \PDO $dbc;

    public function __construct(\PDO $dbconection){
        $this->dbc = $dbconection;
    }
}