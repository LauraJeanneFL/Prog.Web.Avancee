<?php
require_once('class/Calculator.php');

$cal = new Calculator;
echo $result = $cal->add(1, 4);
echo "<br>";
//echo $cal->message;

echo "<hr>";

echo Calculator::add(5,6);

echo "<hr>";

echo Calculator::$message;
