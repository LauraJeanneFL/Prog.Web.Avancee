<?php
// tableau associatif du tableau formulaire
//print_r($_POST);

//version peu optimiser 
//$name = $_POST ['name'];
//$adress = $_POST ['adress'];
//$phone = $_POST ['phone'];
//$zip_code = $_POST ['zip_code'];
//$email = $_POST ['email'];
//echo "<br>";
//echo $email;
//echo "<br>";
//---------------------------------------------
/* -> echo $key. " = " .$value. "<br>";
Affiche:
name = LJ
address = 333 avenue Landry
phone = 5145544544
zip_code = H1B 2    C3
email = exemple@gmail.com
*/
//------------------
if($_SERVER['REQUEST_METHOD'] != "POST"){
    header('location:client-index.php');
    exit;
}


// print_r($_POST);

// $name = $_POST['name'];
// $address = $_POST['address'];
// $phone = $_POST['phone'];
// $zip_code = $_POST['zip_code'];
// $email = $_POST['email'];

// echo "<br>";

foreach($_POST as $key=>$value){
   // echo $key." = ".$value."<br>";
   $$key = $value;
}


require_once('db/connex.php');
// $sql = "INSERT INTO client (name, address, phone, zip_code, email) VALUE ('$name', '$address', '$phone', '$zip_code', '$email');";
// $stmt = $pdo->query($sql);


$sql = "INSERT INTO client (name, address, phone, zip_code, email) VALUE (?, ?, ?, ?, ?);";
$stmt = $pdo->prepare($sql);
if($stmt->execute(array($name, $address, $phone, $zip_code, $email))){
    $id = $pdo->lastInsertId();
    header('location:client-show.php?id='.$id);
}else{
    print_r($stmt->errorInfo());
}









?>