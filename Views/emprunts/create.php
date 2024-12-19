{% extends 'layout.php' %}

{% block content %}
    <h1>Créer un emprunt</h1>
    <form action="{{ base }}emprunts/store" method="POST" >
        <label for="nom_emprunteur">Nom de l'emprunteur
            <input type="text" name="nom_emprunteur" required>
        </label>

        <label for="id_livre">ID du livre
            <input type="number" name="id_livre" required>
        </label>

        <button type="submit">Enregistrer</button>
    </form>
{% endblock %}