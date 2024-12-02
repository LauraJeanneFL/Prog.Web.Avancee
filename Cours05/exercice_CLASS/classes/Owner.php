<?php

class Owner {
    private string $name;
    private string $address;
    private string $zipCode;
    private string $phone;
    private string $email;

    // Constructeur
    public function __construct(string $name, string $address, string $zipCode, string $phone, string $email){
        $this->name = $name;
        $this->address = $address;
        $this->zipCode = $zipCode;
        $this->phone = $phone;
        $this->email = $email;
    }

    // Getters
    public function getName(): string {
        return $this->name;
    }

    public function getAddress(): string {
        return $this->address;
    }

    public function getZipCode(): string {
        return $this->zipCode;
    }

    public function getPhone(): string {
        return $this->phone;
    }

    public function getEmail(): string {
        return $this->email;
    }

    // Setters
    public function setName(string $name): void {
        $this->name = $name;
    }

    public function setAdress(string $address): void {
        $this->address = $address;
    }

    public function setZipCode(string $zipCode): void {
        $this->zipCode = $zipCode;
    }

    public function setPhone(string $phone): void {
        $this->phone = $phone;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

}