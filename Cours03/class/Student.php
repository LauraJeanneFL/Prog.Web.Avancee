<?php
require_once 'Person.php';

class Student extends Person{
    public int $studentId;

    // public function __construct($name, $studentId){
    //     $this->name = $name;
    //     $this->studentId = $studentId;
    // }

    public function setEmail($email){
        $this->email = $email;
    }

    public function message(){
        return 'Salut les etudiants';
    }

    public function setProp($name, $email, $a = null){
        $this->name = $name;
        $this->email = $email;
        $this->studentId = $studentId;
}