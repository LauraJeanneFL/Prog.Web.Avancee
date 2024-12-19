{% extends 'layout.php' %}

{% block content %}
<h1>Ajouter un nouveau livre</h1>
<form action="{{ base }}livres/store" method="post">
    <label for="titre">Titre :</label>
    <input type="text" id="titre" name="titre" required>
    <br>
    <label for="annee_publication">Année de publication :</label>
    <input type="number" id="annee_publication" name="annee_publication" required>
    <br>
    <label for="id_auteur">Auteur :</label>
    <input type="text" id="id_auteur" name="id_auteur" required>
    <br>
    <label for="id_genre">Genre :</label>
    <input type="text" id="id_genre" name="id_genre" required>
    <br>
    <label for="quantite_disponible">Quantité disponible :</label>
    <input type="number" id="quantite_disponible" name="quantite_disponible" required>
    <br>
    <button type="submit">Enregistrer</button>
</form>
{% endblock %}