<?php
require_once 'class/Teacher.php';

$teacher = new Teacher('Lisa');


$teacher->setProp('lisa@gmail.com', 4575, 100.00);
echo"<pre>";
var_dump($teacher);
echo"</pre>";