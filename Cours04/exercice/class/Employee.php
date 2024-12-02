<?php
require_once "Person.php";

class Employe extends Person {
    private int $salary;

    public function getSalary(){
        return $this->salary;
    }

    public function setSalary($salary) {
        $this->salary = $salary;
    }
}