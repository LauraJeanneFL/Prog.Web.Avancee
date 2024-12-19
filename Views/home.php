<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= ASSET; ?>css/style.css">
</head>
<body>  
    {% extends 'layout.php' %}

    {% block content %}
    <h1>Bienvenue, Administrateur</h1>
    <p>Accédez aux sections via le menu.</p>
    {% endblock %}
</body>
</html>