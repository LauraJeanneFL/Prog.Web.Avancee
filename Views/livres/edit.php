{% extends 'layout.php' %}

{% block content %}
<h1>Modifier un livre</h1>
<form action="{{ base }}livres/update/{{ livre.id_livre }}" method="POST" >
    <label for="titre">Titre:</label>
    <input type="text" name="titre" id="titre" value="{{ livre.titre }}" required>

    <label for="annee_publication">Année de publication:</label>
    <input type="number" name="annee_publication" id="annee_publication" value="{{ livre.annee_publication }}" required>

    <label for="id_auteur">Auteur:</label>
    <select name="id_auteur" id="id_auteur" required>
        <!-- Options à remplir dynamiquement -->
    </select>

    <label for="id_genre">Genre:</label>
    <select name="id_genre" id="id_genre" required>
        <!-- Options à remplir dynamiquement -->
    </select>

    <label for="quantite_disponible">Quantité disponible:</label>
    <input type="number" name="quantite_disponible" id="quantite_disponible" value="{{ livre.quantite_disponible }}" required>
    
    <button type="submit">Enregistrer</button>
</form>
{% endblock %}