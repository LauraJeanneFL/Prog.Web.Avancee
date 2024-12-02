<?php
require_once "Person.php";

$obj = new Person('Paul', 'Maisonneuve', '5454545', 'paul@gmail.com');

echo "<pre>";
var_dump($obj);
echo "</pre>";

?>
