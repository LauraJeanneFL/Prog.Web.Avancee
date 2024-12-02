<?php
if (isset($_GET['id']) && $_GET['id'] != null) {
    require_once('db/connex.php');
    $id =  $_GET['id'];

    $sql = "SELECT * FROM client WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($id));

    $count = $stmt->rowCount();
    if ($count == 1){
        $client = $stmt->fetch();
    }else {
    header('location: client-index.php');
    }

}else {
    header('location: client-index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Show</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Client</h1>
        <p><strong>Name: </strong><?php $client['name'];?></p>
        <p><strong>Adress: </strong><?php $client['address'];?></p>
        <p><strong>Phone: </strong><?php $client['phone'];?></p>
        <p><strong>Zip Code: </strong><?php $client['zip_code'];?></p>
        <p><strong>Email: </strong><?php $client['email'];?></p>
        <a href="client-edit.php?id=<?= $client['id'];?>" class="btn">Edit</a>
    </div>
</body>
</html>