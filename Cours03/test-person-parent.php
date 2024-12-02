<?php
require_once 'class/Person.php';


$person = new Person('Peter');

//$person->name = 'paul';

//echo $person->name;

echo"<pre>";
var_dump($person);
echo"</pre>";