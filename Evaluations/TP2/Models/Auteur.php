<?php 

namespace App\Models;

use PDO;
use App\Models\CRUD;

class Auteur {


   /*  
    private $pdo;
   
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    } */
     protected $table = 'auteur';
     protected $primaryKey = 'id_auteur';
     protected $fillable = ['prenom', 'nom'];

    /* // Méthode pour ajouter un auteur
    public function ajouterAuteur($prenom, $nom) {
        $sql = "INSERT INTO auteur (prenom, nom) VALUES (:prenom, :nom)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':prenom', $prenom);
        $stmt->bindValue(':nom', $nom);
        $stmt->execute();
    }

    // Méthode pour modifier un auteur
    public function modifierAuteur($id_auteur, $data) {
        $sql = "UPDATE auteur SET prenom = :prenom, nom = :nom WHERE id_auteur = :id_auteur";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':prenom', $data['prenom']);
        $stmt->bindValue(':nom', $data['nom']);
        $stmt->bindValue(':id_auteur', $id_auteur, PDO::PARAM_INT);
        return $stmt->execute();
    }


    // Méthode pour supprimer un auteur
    public function supprimerAuteur($id_auteur) {
        $sql = "DELETE FROM auteur WHERE id_auteur = :id_auteur";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id_auteur', $id_auteur);
        return $stmt->execute();
    }

     public function getById($id) {
        $sql = "SELECT * FROM auteur WHERE id_auteur = :id";
        $stmt = $this->pdo->prepare($sql); // Utilise PDO pour préparer la requête
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    // Méthode pour récupérer tous les auteurs
    public function getAll() {
        $sql = "SELECT * FROM auteur";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } */
}