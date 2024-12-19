<?php

namespace App\Models;

class Personne {
    protected $prenom;
    protected $nom;

    public function __construct($prenom = null, $nom = null) {
        $this->prenom = $prenom;
        $this->nom = $nom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getFullName() {
        return $this->prenom . ' ' . $this->nom;
    }

    
}