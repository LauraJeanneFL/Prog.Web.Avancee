
<?php
require_once('Person.php');

$obj = new Person;

$obj->setProps('Peter', 'Pie IX', '333333', 'peter@gmail.com');

echo "<pre>";
var_dump($obj);
echo "</pre>";

echo "<hr>";
$obj2 = new Person;

$obj2->setProps('Marie', 'Sherbrooke', '4444');
//echo $obj2->setProps('Marie', '', '4444');

echo $obj2->getMessage();


echo "<pre>";
var_dump($obj2);
echo "</pre>";
?>
