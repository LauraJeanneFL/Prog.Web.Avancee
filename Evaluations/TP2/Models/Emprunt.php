<?php

namespace App\Models;

use PDO;

class Emprunt {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Méthode pour ajouter un emprunt
    public function ajouterEmprunt($data) {
        $sql = "INSERT INTO emprunt (id_livre, nom_emprunteur, date_emprunt, date_retour) 
                VALUES (:id_livre, :nom_emprunteur, :date_emprunt, :date_retour)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id_livre', $data['id_livre']);
        $stmt->bindValue(':nom_emprunteur', $data['nom_emprunteur']);
        $stmt->bindValue(':date_emprunt', $data['date_emprunt']);
        $stmt->bindValue(':date_retour', $data['date_retour'] ?? null);

        return $stmt->execute();
    }

    // Méthode pour modifier un emprunt
    public function modifierEmprunt($id_emprunt, $date_retour) {
        $sql = "UPDATE emprunt SET date_retour = :date_retour WHERE id_emprunt = :id_emprunt";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':date_retour', $date_retour);
        $stmt->bindValue(':id_emprunt', $id_emprunt);
        return $stmt->execute();
    }

    // Méthode pour supprimer un emprunt
    public function supprimerEmprunt($id_emprunt) {
        $sql = "DELETE FROM emprunt WHERE id_emprunt = :id_emprunt";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id_emprunt', $id_emprunt);
        return $stmt->execute();
    }

    // Méthode pour récupérer tous les emprunts
    public function getEmprunts() {
        $sql = "SELECT * FROM emprunt";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}