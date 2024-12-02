<?php

class CRUD extends PDO {
    public function __construct() {
        parent::__construct('mysql:host=localhost; dbname=ecommerce; port=3306; charset=utf8', 'root', '');
    }

    public function select($table){
        $sql= "SELECT * FROM $table";
        $stmt = $this->query($sql);
        return $stmt->fetchAll();
    }
}

