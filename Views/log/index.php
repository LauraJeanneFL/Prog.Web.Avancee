{% extends 'layout.php' %}
<body>
    <h1>Journal de bord</h1>
    <table>
        <tr>
            <th>ID Utilisateur</th>
            <th>IP</th>
            <th>Date</th>
            <th>Page</th>
        </tr>
        {% for log in logs %}
            <tr>
                <td>{{ log.id_utilisateur ?? 'Visiteur' }}</td>
                <td>{{ log.ip }}</td>
                <td>{{ log.date }}</td>
                <td>{{ log.page }}</td>
            </tr>
        {% endfor %}
    </table>
</body>