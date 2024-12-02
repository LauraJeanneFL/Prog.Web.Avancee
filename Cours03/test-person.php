<?php
require_once('class/Person.php');


$obj = new Person('Peter', 'peter@gmail.com');

//$obj->email = "peter@gmail.com";
print_r($obj);

//echo $obj->email;

echo "<br>";

$obj->showMagic();

echo"<pre>";
var_dump($obj);
echo"</pre>";