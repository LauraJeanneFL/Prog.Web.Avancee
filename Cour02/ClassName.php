<?php
// L'ajout de propriétés à une classe suit certaines conventions :
// Moficiateur d'access: mot-clé public est préfixé à un propriété 
//de classe pour définir sa visibilité.

class ClassName {
    public string $prop1 = "valeur par default"; //défini comme une chaîne sans valeur par défaut. 
    public int $prop2;
    public float $prop3;
    public bool $prop4;// valeur par défaut de true.


    // Méthode de la classe
    public function classMethod($parm1, $parm2){
        // logic
        return "$parm1 et $parm2";
    }
}