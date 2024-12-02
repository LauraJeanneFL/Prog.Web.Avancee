<?php
abstract class Person {
    private string $name;  
    public string $address;  
    public string $zipCode = 'H1H1H1';  
    public string $phone;  
    protected string $email; 

    abstract public function message();

    abstract function setProp($a, $b, $c);

    final public function __construct($name){
        $this->name = $name;
    }

    // final public function message(){
    //     echo 'abc Person';
    // }
 }
?>