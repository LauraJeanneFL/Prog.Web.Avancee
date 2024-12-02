
<?php
if($_SERVER['REQUEST_METHOD'] != "POST"){
    header('location:client-index.php');
    exit;
}

foreach($_POST as $key=>$value){
    $$key = $value;
 }

 //print_r($_POST);

 $sql="DELETE FROM client WHERE id = ?";
 require_once('db/connex.php');
 $stmt = $pdo->prepare($sql);
 if($stmt->execute(array($id))){
    header("location:client-index.php");
 }else{
    print_r($stmt->errorInfo());
 }

 ?>
