<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ title }}</title>
    <link rel="stylesheet" href="http://localhost/ProgWebAvancee/Evaluations/TP3/public/assets/style.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="{{ base }}auteurs">Auteurs</a></li>
            <li><a href="{{ base }}genres">Genres</a></li>
            <li><a href="{{ base }}livres">Livres</a></li>
            <li><a href="{{ base }}emprunts">Emprunts</a></li>
            <li><a href="{{ base }}users">Users</a></li>
        </ul>
        <ul>
            <li><a href="{{ base }}login">Login</a></li>
            <li><a href="{{ base }}logout">Déconnexion</a></li>
           {% if session.role == 'admin' %}
                <li><a href="{{ base }}logs">Journal de bord</a></li>
                <li><a href="{{ base }}admin">Administration</a></li>
            {% endif %}
        </ul>
    </nav>
    <main>
        {% block content %}{% endblock %}
    </main>
    <footer>
        <p>2024 All rights reserved</p>
    </footer>
</body>
</html>