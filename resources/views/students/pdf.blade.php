<!DOCTYPE html>
<html>
<head>
    <title>Liste des Élèves</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Liste des Élèves - Classe {{ $students->first()->classModel->name ?? 'Non spécifiée' }}</h1>
    <table>
        <thead>
            <tr>
                <th>Prénom et Nom</th>
                <th>Téléphone</th>
                <th>Email</th>
                <th>Classe Assignée</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                    <td>{{ $student->phone_number }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->classModel->name ?? 'Aucune' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
