<?php

namespace App\Models;

use PDO;

class Livre {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Méthode pour récupérer tous les livres
    public function getAll(): array {
        $sql = "SELECT livre.id_livre, livre.titre, livre.annee_publication, livre.quantite_disponible, 
                       auteur.prenom AS auteur_prenom, auteur.nom AS auteur_nom, genre.nom_genre 
                FROM livre
                JOIN auteur ON livre.id_auteur = auteur.id_auteur
                JOIN genre ON livre.id_genre = genre.id_genre";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Méthode pour ajouter un livre
    public function create(array $data): void {
        $sql = "INSERT INTO livre (titre, annee_publication, id_auteur, id_genre, quantite_disponible)
                VALUES (:titre, :annee_publication, :id_auteur, :id_genre, :quantite_disponible)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':titre' => $data['titre'],
            ':annee_publication' => $data['annee_publication'],
            ':id_auteur' => $data['id_auteur'],
            ':id_genre' => $data['id_genre'],
            ':quantite_disponible' => $data['quantite_disponible']
        ]);
    }

    // Méthode pour récupérer un livre par son ID
    public function getById(int $id): ?array {
        $sql = "SELECT * FROM livre WHERE id_livre = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    // Méthode pour mettre à jour un livre
    public function update(int $id, array $data): void {
        $sql = "UPDATE livre 
                SET titre = :titre, 
                    annee_publication = :annee_publication, 
                    id_auteur = :id_auteur, 
                    id_genre = :id_genre, 
                    quantite_disponible = :quantite_disponible 
                WHERE id_livre = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':titre' => $data['titre'],
            ':annee_publication' => $data['annee_publication'],
            ':id_auteur' => $data['id_auteur'],
            ':id_genre' => $data['id_genre'],
            ':quantite_disponible' => $data['quantite_disponible'],
            ':id' => $id
        ]);
    }

    // Méthode pour supprimer un livre
    public function delete(int $id): void {
        $sql = "DELETE FROM livre WHERE id_livre = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
    }
}