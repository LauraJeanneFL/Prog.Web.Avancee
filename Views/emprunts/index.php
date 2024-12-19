{% extends 'layout.php' %}

{% block content %}
    <h1>Liste des emprunts</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Livre</th>
                <th>Nom de l'emprunteur</th>
                <th>Date d'emprunt</th>
                <th>Date de retour</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            {% for emprunt in emprunts %}
            <tr>
                <td>{{ emprunt.id_emprunt }}</td>
                <td>{{ emprunt.id_livre }}</td>
                <td>{{ emprunt.nom_emprunteur }}</td>
                <td>{{ emprunt.date_emprunt }}</td>
                <td>{{ emprunt.date_retour }}</td>
                <td>
                    <a href="{{ base }}emprunts/edit/{{ emprunt.id_emprunt }}">Modifier</a>
                    <form action="{{ base }}emprunts/delete/{{ emprunt.id_emprunt }}"  method="post" style="display:inline;">
                        <input type="hidden" name="id" value="{{ emprunt.id_emprunt }}">
                        <button type="submit">Supprimer</button>
                    </form>
                </td>
            </tr>
            {% endfor %}
        </tbody>
    </table>
{% endblock %}