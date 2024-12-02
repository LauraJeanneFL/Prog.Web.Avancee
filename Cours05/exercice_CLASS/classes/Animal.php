<?php

abstract class Animal {
    protected string $specie = 'Chat';

    //methode
    public function setProp(string $specie) {
        $this->specie = $specie;
    }
    public function getProp() {
        return $this->specie;
    }
}