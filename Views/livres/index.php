{% extends 'layout.php' %}

{% block content %}
<h1>Liste des livres</h1>
<table>
    <tr>
        <th>Titre</th>
        <th>Auteur</th>
        <th>Genre</th>
        <th>Année</th>
        <th>Quantité</th>
        <th>Actions</th>
    </tr>
    {% for livre in livres %}
        <tr>
            <td>{{ livre.titre }}</td>
            <td>{{ livre.auteur_prenom }} {{ livre.auteur_nom }}</td>
            <td>{{ livre.nom_genre }}</td>
            <td>{{ livre.annee_publication }}</td>
            <td>{{ livre.quantite_disponible }}</td>
            <td>
                <a href="{{ base }}livres/edit/{{ livre.id_livre }}">Modifier</a>
                <form action="{{ base }}livres/delete/{{ livre.id_livre }}" method="post" style="display:inline;">
                    <input type="hidden" name="id" value="{{ livre.id_livre }}">
                    <button type="submit" name="supprimer">Supprimer</button>
                </form>
            </td>
        </tr>
    {% endfor %}
</table>
{% endblock %}