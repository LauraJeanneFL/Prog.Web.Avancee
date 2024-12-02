<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclure les classes nécessaires
require_once('classes/Owner.php');
require_once('classes/Pet.php');
require_once('classes/Animal.php');

// Instanciation des objets Owner et Pet
$owner1 = new Owner("Jean Dupont", "123 Rue Principale", "H1A 1A1", "514-123-4567", "jean.dupont@gmail.com");
$owner2 = new Owner("Marie Tremblay", "456 Rue Secondaire", "H2B 2B2", "514-987-6543", "marie.tremblay@gmail.com");

$cat1 = new Pet("Minou", new DateTime("2019-05-10"));
$cat2 = new Pet("Félix", new DateTime("2023-08-15"));
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Infos des propriétaires et animaux</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<h1>Informations des propriétaires</h1>
<div>
    <h2>Propriétaire #1</h2>
        <div class="owner">
            <img src="assets/img/cat-01.jpg" alt="minou-01">
            <p> <i class="fas fa-user"></i> Nom: <?= $owner1->getName(); ?></p>
            <p> <i class="fas fa-map-marker-alt"></i> Adresse: <?= $owner1->getAddress(); ?></p>
            <p> <i class="fas fa-mail-bulk"></i> Code postal: <?= $owner1->getZipCode() ?></p>
            <p><i class="fas fa-phone"></i> <?= $owner1->getPhone(); ?></p>
            <p> <i class="fas fa-envelope"></i> Email: <?= $owner1->getEmail() ?></p>
            <p>Animal: <?= $cat1->getName(); ?> (Espèce: <?= $cat1->getProp(); ?>, Âge: <?= $cat1->getAge(); ?> ans)</p>
        </div>
</div>

<div>
    <h2>Propriétaire #2</h2>
        <div class="owner">
            <img src="assets/img/cat-02.jpg" alt="minou-02">
            <p><i class="fas fa-user"></i> Nom: <?= $owner2->getName(); ?></p>
            <p><i class="fas fa-map-marker-alt"></i> Adresse: <?= $owner2->getAddress(); ?></p>
            <p> <i class="fas fa-mail-bulk"></i>Code postal: <?=$owner2->getZipCode() ?></p>
            <p><i class="fas fa-phone"></i> <?= $owner2->getPhone(); ?></p> 
            <p> <i class="fas fa-envelope"></i> Email: <?= $owner1->getEmail() ?>
            <p>Animal: <?= $cat2->getName(); ?> (Espèce: <?= $cat2->getProp(); ?>, Âge: <?= $cat2->getAge(); ?> ans)</p>
        </div>
</div>

</body>
</html>
