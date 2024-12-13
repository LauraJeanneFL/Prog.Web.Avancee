<?php
namespace App\Models;

abstract class CRUD extends \PDO {
    final public function __construct() {
        parent::__construct('mysql:host=localhost; dbname=ecommerce; port=3306; charset=utf8', 'root', '');
    }

    final public function select($field = null, $order='ASC'){
        if($field == null){
            $field = $this->primaryKey;
        }
        $sql= "SELECT * FROM $this->table ORDER BY $field $order";
        if($stmt = $this->query($sql)){
            return $stmt->fetchAll();
        }else{
            return false;
        } 
    }

    final public function selectId($value){
        $sql= "SELECT * FROM $this->table WHERE $this->primaryKey = :$this->primaryKey";
        $stmt= $this->prepare($sql);
        $stmt->bindValue(":$this->primaryKey", $value);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count==1){
            return $stmt->fetch();
        }else{
            return false;
        }
    }

    final public function insert($data){

        $dataKeys = array_fill_keys($this->fillable,'');
        $data = array_intersect_key($data, $dataKeys);

        $fieldName = implode(', ', array_keys($data));
        $fieldValue= ":".implode(', :', array_keys($data));

        $sql = "INSERT INTO $this->table ($fieldName) VALUES($fieldValue)";

        $stmt = $this->prepare($sql);
        foreach($data as $key=>$value){
            $stmt->bindValue(":$key", $value);
        }
        if($stmt->execute()){
            return $this->lastInsertId();
        }else{
            return false;
        }
    }

    final public function update($data, $id){

        $dataKeys = array_fill_keys($this->fillable,'');
        $data = array_intersect_key($data, $dataKeys);

        $fieldName = null;
        foreach($data as $key=>$value){
            $fieldName .= "$key = :$key, ";
        }
        $fieldName = rtrim($fieldName, ', ');

        $sql = "UPDATE $this->table SET $fieldName WHERE $this->primaryKey = :$this->primaryKey";
        $data[$this->primaryKey] = $id;
        $stmt = $this->prepare($sql);
        foreach($data as $key=>$value){
            $stmt->bindValue(":$key", $value);
        }
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    final public function delete($id){
        if($this->selectId($id)){
            $sql = "DELETE FROM $this->table WHERE $this->primaryKey = :$this->primaryKey";
            $stmt = $this->prepare($sql);
            $stmt->bindValue("$this->primaryKey", $id);
            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}

?>