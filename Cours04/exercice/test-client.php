<?php
require_once "class/Client.php";

$newClient = new Client("Sam", "221 Sous-Coline", "", "La Comptée","commun");
echo"<pre>";
var_dump($newClient);
echo"</pre>";

//test de la fonction setPhone du parent (Person)
$newClient->setPhone("221-1122");
// echo $newEmploye->phone; ne fonctionne pas car la valeur est proteger
// utilisation de la fonction publique getPhone pour y acceder.
echo $newClient->getPhone();
echo"<pre>";
var_dump($newClient);
echo"</pre>";

/* 
$newClient->account = "2222";
$newClient->setAccount("2222");
echo $newClient->getPhone();
echo"<pre>";
var_dump($newClient);
echo"</pre>";

//test sur l'encienneté
$newClient->setDateAdhesion( '2015-06-15');
echo"<pre>";
var_dump($newClient);
echo"</pre>";
echo "Ancienneté : " . $newClient->getAnciennete() . " ans"; */