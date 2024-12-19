{% extends 'layout.php' %}

{% block content %}
<h1>Liste des Auteurs</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        {% for auteur in auteurs %}
        <tr>
            <td>{{ auteur.id_auteur }}</td>
            <td>{{ auteur.prenom }}</td>
            <td>{{ auteur.nom }}</td>
            <td>
                <a href="{{ base }}auteurs/edit/{{ auteur.id_auteur }}">Modifier</a>
                <form action="{{ base }}auteurs/delete/{{ auteur.id_auteur }}" method="post" style="display:inline;">
                    <input type="hidden" name="id" value="{{ auteur.id_auteur }}">
                    <button type="submit" onclick="return confirm('Confirmer la suppression ?');">Supprimer</button>
                </form>
            </td>
        </tr>
        {% endfor %}
    </tbody>
</table>
{% endblock %}