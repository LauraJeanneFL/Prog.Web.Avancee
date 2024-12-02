<?php
require_once 'Person.php';

class Teacher extends Person{
    public int $teacherId;
    public float $salary;

    public function message(){
        return 'Salut tous';
    }
    
    public function setProp($email, $teacherId, $salary){
        $this->email = $email;
        $this->teacherId = $teacherId;
        $this->salary = $salary;
    }

}