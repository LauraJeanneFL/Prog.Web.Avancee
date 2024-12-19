{% extends 'layout.php' %}

{% block content %}
<h1>Liste des genres</h1>
<table>
    <tr>
        <th>ID</th>
        <th>Nom du genre</th>
        <th>Actions</th>
    </tr>
    {% for genre in genres %}
        <tr>
            <td>{{ genre.id_genre }}</td>
            <td>{{ genre.nom_genre }}</td>
            <td>
                <a href="{{ base }}genres/edit/{{ genre.id_genre }}">Modifier</a>
                <form action="{{ base }}genres/delete/{{ genre.id_genre }} ">
                     <input type="hidden" name="id" value="{{ genre.id_genre }}">
                    <button type="submit">Supprimer</button>
                </form>
            </td>
        </tr>
    {% endfor %}
</table>
{% endblock %}