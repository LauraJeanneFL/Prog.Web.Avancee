<?php
class Calculator{
    //public $message = 'the result is :';
    public static $message = 'The result is : ';
    public static function add($a, $b){
        $result = $a + $b; 
        return self::$message.$result;
        // quand on travaille avec static pas possible d'uliser this. 
        // utiliser que des éléments statics
                //return $this->$message.$result;
    }
}
/* 

// quand on travaille avec static pas possible d'uliser this. 
        // utiliser que des éléments statics
En programmation orientée objet, une méthode statique est une méthode qui appartient à une classe plutôt qu'une instance de la classe. Contrairement aux méthodes d'instance, qui opèrent sur les instances de la classe et ont accès aux données spécifiques à l'instance, les méthodes statiques sont associées à la classe elle-même et n'ont pas accès aux données spécifiques à l'instance.



Voici quelques caractéristiques clés des méthodes statiques :

Appartient à la classe :

Les méthodes statiques sont définies au niveau niveau de classe, et ils sont associés à la classe plutôt qu'à une instance de la classe.
Ils sont invoqués en utilisant le nom de la classe plutôt qu'une instance de la classe.
Aucun accès aux données d'instance :

Les méthodes statiques n'ont pas accès aux données ou propriétés spécifiques à l'instance. Ils opèrent au niveau de la classe et ne peuvent pas faire référence à cette variable ni à aucune variable d'instance.
Déclaré avec le mot-clé statique :

Dans dans de nombreux langages de programmation, notamment Java, C++, C# et PHP, les méthodes statiques sont déclarées à l'aide du mot-clé static.
Peut être appelée sans créer d'instance :

Puisque les méthodes statiques appartiennent à la classe, elles peuvent être appelées directement sur la classe sans créer d'instance de la classe. */