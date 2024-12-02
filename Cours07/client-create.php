<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New client</title>
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
        <form action="client-store.php" method="POST">
            <h2>Add a new client: </h2>
            <div>
                <label>Name:
                     <input type="text" name="name">
                </label>
            </div>
            <div>
                <label>Address:
                    <input type="text" name="address">
                </label>
            </div>
            <div>
                <label>Phone:
                    <input type="text" name="phone">
                </label>
            </div>
            <div>
                <label>Zip Code:
                    <input type="text" name="zip_code" id="">
                </label>
            </div>
            <div>
                <label for="email">Email:
                    <input type="email" name="email">
                </label>
            </div>
            <input type="submit" class="btn" value="Save">
        </form>
    </div>
</body>
</html>