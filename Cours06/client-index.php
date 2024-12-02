<?php
require_once('db/connex.php');

$sql = "SELECT * from client ORDER by name;";
// $pdo vient de db/connex.php
$stmt = $pdo->query($sql);

//$client = $stmt->fetchAll();

/* echo "<pre>";
var_dump($client);
echo "</pre>";
 */

/* foreach ($stmt as $row){
    print_r($row);
    echo "<br>";
} */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clients</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Clients</h1>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Adress</th>
                <th>Phone</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($stmt as $row) {
            ?>
            <tr>
                <td><?=$row ['name']?></td>
                <td><?=$row ['adress']?></td>
                <td><?=$row ['phone']?></td>
                <td><?=$row ['email']?></td>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
</body>
</html>