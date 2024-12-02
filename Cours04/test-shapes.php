<?php

require_once('class/Circle.php');
require_once('class/Rectangle.php');


echo "Circle Area : ";
$circle = new Circle(2);

echo $circle->calcArea();

echo "<hr>Rectangle Area : ";
$rectangle = new Rectangle(10, 15);
echo $rectangle->calcArea();