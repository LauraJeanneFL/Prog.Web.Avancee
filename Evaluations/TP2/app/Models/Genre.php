<?php

namespace App\Models;

use PDO;

class Genre {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Méthode pour récupérer tous les genres
    public function getGenres() {
        $sql = "SELECT * FROM genre";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Méthode pour ajouter un genre
    public function ajouterGenre($nom_genre) {
        $sql = "INSERT INTO genre (nom_genre) VALUES (:nom_genre)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nom_genre', $nom_genre);
        return $stmt->execute();
    }

    // Méthode pour modifier un genre
    public function modifierGenre($id_genre, $nom_genre) {
        $sql = "UPDATE genre SET nom_genre = :nom_genre WHERE id_genre = :id_genre";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nom_genre', $nom_genre);
        $stmt->bindValue(':id_genre', $id_genre);
        return $stmt->execute();
    }

    // Méthode pour supprimer un genre
    public function supprimerGenre($id_genre) {
        $sql = "DELETE FROM genre WHERE id_genre = :id_genre";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id_genre', $id_genre);
        return $stmt->execute();
    }
}