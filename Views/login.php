{% extends 'layout.php' %}

{% block content %}
<h1>Connexion</h1>
<form action="{{ base }}login" method="POST">
    <label for="username">Nom d'utilisateur:</label>
    <input type="text" name="username" id="username" required>
    
    <label for="password">Mot de passe:</label>
    <input type="password" name="password" id="password" required>
    
    <button type="submit">Se connecter</button>
</form>
{% endblock %}