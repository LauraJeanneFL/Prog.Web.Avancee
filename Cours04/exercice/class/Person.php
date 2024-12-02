<?php
    abstract class Person {
        public string $name;
        public string $address;
        protected string $phone;
        public string $country;
        private string $language;
    
    public function setPhone($phone) {
        $this->phone = $phone ;
    }
    public function getPhone() {
        return $this->phone;
    }

    public function setlanguage($language) {
        $this->language = $language ;
    }
    public function getlanguage() {
        return $this->language;
    }

    final public function __construct($name, $address, $phone, $country, $language) {
        $this->name = $name;
        $this->address = $address;
        $this->phone = $phone;
        $this->country = $country;
        $this->language = $language;
    }
  
}