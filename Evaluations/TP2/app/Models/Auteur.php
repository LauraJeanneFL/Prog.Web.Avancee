<?php 

namespace App\Models;

use PDO;

class Auteur {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Méthode pour ajouter un auteur
    public function ajouterAuteur($data) {
        $sql = "INSERT INTO auteur (prenom, nom) VALUES (:prenom, :nom)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':prenom', $data['prenom']);
        $stmt->bindValue(':nom', $data['nom']);
        return $stmt->execute();
    }

    // Méthode pour modifier un auteur
    public function modifierAuteur($id_auteur, $data) {
        $sql = "UPDATE auteur SET prenom = :prenom, nom = :nom WHERE id_auteur = :id_auteur";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':prenom', $data['prenom']);
        $stmt->bindValue(':nom', $data['nom']);
        $stmt->bindValue(':id_auteur', $id_auteur);
        return $stmt->execute();
    }

    // Méthode pour supprimer un auteur
    public function supprimerAuteur($id_auteur) {
        $sql = "DELETE FROM auteur WHERE id_auteur = :id_auteur";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id_auteur', $id_auteur);
        return $stmt->execute();
    }

    // Méthode pour récupérer tous les auteurs
    public function getAll() {
        $sql = "SELECT * FROM auteur";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}