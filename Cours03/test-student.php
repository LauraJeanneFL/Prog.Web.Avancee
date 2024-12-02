<?php
require_once 'class/Student.php';

$student = new Student('Peter', 4545);

//$student->name = "Peter";
$student->setEmail("Peter@gmail.com");
//$student->studentId = 14141;


echo $student->message();
echo"<pre>";
var_dump($student);
echo"</pre>";
?>