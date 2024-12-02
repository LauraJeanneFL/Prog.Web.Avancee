<?php
require_once "class/Employe.php";
//test du contructor
$newEmploye = new Employe("Frodon","222 Sous-Coline", "", "La Comptée","commun");
echo"<pre>";
var_dump($newEmploye);
echo"</pre>";

//test de la fonction setPhone du parent (Person)
$newEmploye->setPhone("222-2222");
// echo $newEmploye->phone; ne fonctionne pas car la valeur est proteger
// utilisation de la fonction publique getPhone pour y acceder.
echo $newEmploye->getPhone();
//test de la fonction setSalary de la class Employe
$newEmploye->setSalary(150);
echo"<pre>";
var_dump($newEmploye);
echo"</pre>";

//test de la fonction getSalary de la class Employe
// echo $newEmploye->salary; ne fonctionne pas car la valeur est privé
echo $newEmploye->getSalary();