<?php
require_once ('classes/Animal.php');

class Pet extends Animal {
    public string $name;
    public DateTime $birthday;

    // Constructeur
    // Attribut dérivé
    public function __construct(string $name, DateTime $birthday, string $specie = 'Chat') {
        // Appel du constructeur parent (Animal)
        parent::setProp($specie);
        $this->name = $name;
        $this->birthday = $birthday;
    }

    // Méthode pour calculer l'âge en fonction de la date de naissance
    public function getAge(): int {
        $currentDate = new DateTime();
        $interval = $this->birthday->diff($currentDate);
        return $interval->y;
    }

    // Méthode dérivée
    public function setName(string $name){
        $this->name = $name;
    }
    public function getName(): string{
        return $this->name;
    }
}