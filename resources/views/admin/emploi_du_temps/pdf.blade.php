<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Emploi du temps</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .info {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: right;
            font-size: 10px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Emploi du temps</h1>
        <h3>{{ $title }}</h3>
    </div>

    <div class="info">
        <p><strong>Année Scolaire:</strong> {{ $annee->annee ?? 'N/A' }}</p>
        <p><strong>Date d'édition:</strong> {{ date('d/m/Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Jour</th>
                <th>Horaire</th>
                <th>Matière</th>
                @if($type == 'classe')
                    <th>Enseignant</th>
                @else
                    <th>Classe</th>
                @endif
                <th>Salle</th>
            </tr>
        </thead>
        <tbody>
            @foreach($schedules as $schedule)
                <tr>
                    <td>{{ ucfirst($schedule->jour->jours ?? '-') }}</td>
                    <td>{{ $schedule->horaire->heure_debut ?? '-' }} - {{ $schedule->horaire->heure_fin ?? '-' }}</td>
                    <td>{{ $schedule->matiere->nom ?? '-' }}</td>
                    @if($type == 'classe')
                        <td>{{ $schedule->enseignant->nom ?? '-' }} {{ $schedule->enseignant->prenom ?? '' }}</td>
                    @else
                        <td>{{ $schedule->classe->nom ?? '-' }}</td>
                    @endif
                    <td>{{ $schedule->salle ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Généré par SGS - {{ date('Y') }}
    </div>
</body>

</html>