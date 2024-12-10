<?php

try {
    $host = 'localhost';
    $dbname = 'librairie'; // Nom de votre base
    $user = 'root'; // Nom d'utilisateur
    $pass = ''; // Mot de passe

    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connexion réussie à la base de données !";
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}