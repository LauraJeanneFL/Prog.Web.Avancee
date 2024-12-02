<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clients</title>
    <link rel="stylesheet" href="{{asset}}css/style.css">

</head>
<body>
    <h1>Client</h1>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
        {% for client in clients %}
            <tr>
                <td><a href="{{base}}/client/show?id={{client.id}}">{{client.name}}</a></td>
                <td>{{client.address}}</td>
                <td>{{client.phone}}</td>
                <td>{{client.email}}</td>
            </tr>
        {% endfor %}
        </tbody>
    </table>
    <a href="{{base}}/client/create" class="btn">New Client</a>
</body>
</html>
