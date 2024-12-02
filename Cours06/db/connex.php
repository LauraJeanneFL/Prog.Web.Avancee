<?php
// "Petit moule"
try {
    $dbhost = "localhost";
    $dbname = "ecommerce";
    $dbuser = "root";
    $dbpass = "";
    $dbport = 3306; // Par default, pas nécessaire de la mettre
    $pdo = new PDO("mysql:host=$dbhost; dbname=$dbname; port:$dbport; charset=utf8", 
    $dbuser, $dbpass);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();
}