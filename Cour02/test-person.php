<?php
/* 
En PHP, les fonctions require et include permettent toutes deux d’inclure un fichier externe dans un script. 
Cependant, elles présentent quelques différences importantes :

	1.	Comportement en cas d’erreur :
	•	require : Si le fichier spécifié n’est pas trouvé, PHP génère une erreur fatale (fatal error) 
    et arrête l’exécution du script.
	•	include : Si le fichier spécifié n’est pas trouvé, PHP génère un avertissement (warning) 
    mais continue l’exécution du script.
	
    2.	Utilisation :
	•	require: est souvent utilisé lorsque le fichier inclus est indispensable au bon fonctionnement
     du script (par exemple, des fichiers de configuration ou des bibliothèques critiques).
	•	include: est utilisé lorsque le fichier inclus n’est pas strictement nécessaire au fonctionnement
     du script (par exemple, pour des parties de contenu optionnelles).
*/
require_once "Person.php";
// assigner
$obj = new Person($obj);
$obj->name = "Peter"; 
$obj->address = "Pie IX"; 
// Assigne meme si valeur par defaut déjà definie
$obj->zipCode = "H2H2H2"; 


echo "<pre>";
var_dump($obj);
echo "</pre>";

print_r($obj);

echo $obj->name;

echo "<hr>";

$obj2 = new Person($obj2);

$obj2->name = "Marie"; 
$obj2->address = "Sherbrooke";  

echo "<pre>";
var_dump($obj2);
echo "</pre>";

print_r($obj2);
// Possibilité d'afficher une seule propriété
// Récupérer la valeur d'une propriété à partir d'un objet
echo $obj2->name;


?>
