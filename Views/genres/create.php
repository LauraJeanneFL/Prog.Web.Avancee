{% extends 'layout.php' %}

{% block content %}
<h1>Créer un nouveau genre</h1>
<form action="{{ base }}genres/store" method="POST" >
    <label for="nom_genre">Nom du genre:</label>
    <input type="text" name="nom_genre" id="nom_genre" required>
    
    <button type="submit">Enregistrer</button>
</form>
{% endblock %}