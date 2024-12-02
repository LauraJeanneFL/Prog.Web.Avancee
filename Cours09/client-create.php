<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Client</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!--     Méthode POST: Utilisation : Pour envoyer des données au serveur 
    Transmission des données : Les données sont envoyées dans le corps de la requête HTTP, et non dans l’URL.
    Visibilité : Les données ne sont pas visibles dans l’URL, ce qui les rend plus sécurisées pour l’envoi d’informations sensibles

    Méthode GET: Utilisation : Pour récupérer des données depuis le serveur.
    Transmission des données : Les données sont envoyées dans l’URL sous forme de paramètres (query string).
    Visibilité : Les données sont visibles dans l’URL, ce qui les rend moins sécurisées.-->
   <div class="container">
        <form action="client-store.php" method="post">
            <h2>New Client</h2>
            <label>Name
                <input type="text" name="name">
            </label>
            <label>Address
                <input type="text" name="address">
            </label>
            <label>Phone
                <input type="text" name="phone">
            </label>
            <label>Zip Code
                <input type="text" name="zip_code">
            </label>
            <label>Email
                <input type="email" name="email">
            </label>
            <input type="submit" class="btn" value="Save">
        </form>
    </div>
</body>
</html>