<?php
 class Person {
    public string $name;  
    public string $address;  
    public string $zipCode = 'H1H1H1';  
    public string $phone;  
    public string $email; 


    public function __construct(string $name, $address = '', $phone = '', $email = ''){
            $this->name = $name;
            $this->address = $address;
            $this->phone = $phone;
            $this->email = $email;
        }

    // public function setProps(string $name, $address = '', $phone = '', $email = ''):void{
    //     $this->name = $name;
    //     $this->address = $address;
    //     $this->phone = $phone;
    //     $this->email = $email;
    // }

    public function getMessage(): string{
       // return 'Salut  '.$this->name.'!, j habite à .'.$this->address;
        return "Salut  $this->name!, j habite à $this->address";
    }


 }

