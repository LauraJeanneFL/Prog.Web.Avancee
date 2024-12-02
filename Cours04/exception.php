<?php

function divide($dividend, $divisor){
    if ($divisor == 0) {
        throw new Exception('Cannot be divided by Zero', 404);
    }
    return $dividend/$divisor;
}

try{
    echo divide(10,0);
}catch (Exception $e){
    echo "<pre>";
    var_dump($e);
    echo "</pre>";
    echo "<br>".$e->getMessage();
    echo "<br>".$e->getCode();
    echo "<br>".$e->getLine();
    echo "<br>".$e->getFile();
}finally{
    echo "<br>This is the finally";
}
