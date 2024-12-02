<?php
require_once "Person.php";

class Client extends Person {
    private int $account;

    public function setAccount($account){
        $this->account = $account;
    }

    public function getAccount(){
        return $this->account;
    }
}