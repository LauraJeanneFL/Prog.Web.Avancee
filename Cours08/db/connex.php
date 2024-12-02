<?php
try{
    $dbhost = "localhost";
    $dbname = "e2495693";
    $dbuser = "e2495693";
    $dbpass = "nQpNVIW0XbAaYNTxlQKk";
    $dbport = 3306;
    $pdo = new PDO("mysql:host=$dbhost; dbname=$dbname; port=$dbport charset=utf8", $dbuser, $dbpass);
}catch (PDOException $e){
    echo "Error: ". $e->getMessage();
    die();
}

?>