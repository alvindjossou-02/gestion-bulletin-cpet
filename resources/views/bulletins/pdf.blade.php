<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bulletin - {{ $bulletin->apprenant?->nom }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .info-row { display: flex; justify-content: space-between; margin: 10px 0; }
        .label { font-weight: bold; }
        .section { margin-top: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 10px; text-align: left; }
        th { background-color: #f0f0f0; }
    </style>
</head>
<body>
    <div class="header">
        <h1>BULLETIN DE NOTES</h1>
        <p>Gestion des Bulletins - CPET</p>
    </div>

    <div class="section">
        <div class="info-row">
            <span><span class="label">Apprenant:</span> {{ $bulletin->apprenant?->nom }} {{ $bulletin->apprenant?->prenom }}</span>
            <span><span class="label">Matricule:</span> {{ $bulletin->apprenant?->matricule ?? 'N/A' }}</span>
        </div>
        <div class="info-row">
            <span><span class="label">Classe:</span> {{ $bulletin->apprenant?->classe?->nom_classe ?? 'N/A' }}</span>
            <span><span class="label">Filière:</span> {{ $bulletin->apprenant?->filiere?->nom_filiere ?? 'N/A' }}</span>
        </div>
        <div class="info-row">
            <span><span class="label">Trimestre:</span> {{ $bulletin->trimestre }}</span>
            <span><span class="label">Date:</span> {{ now()->format('d/m/Y') }}</span>
        </div>
    </div>

    <div class="section">
        <h2>RÉSULTATS</h2>
        <div class="info-row">
            <span><span class="label">Moyenne Générale:</span> {{ $bulletin->moyenne_generale }}/20</span>
            <span><span class="label">Rang:</span> {{ $bulletin->rang }}e</span>
        </div>
        <div class="info-row">
            <span><span class="label">Appréciation:</span> {{ $bulletin->appreciation ?? 'N/A' }}</span>
        </div>
    </div>

    <div class="section">
        <h2>DÉTAIL DES NOTES PAR MATIÈRE</h2>
        @if($bulletin->apprenant?->notes->count())
            <table>
                <thead>
                    <tr>
                        <th>Matière</th>
                        <th>Type d'Évaluation</th>
                        <th>Note</th>
                        <th>Appréciation</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bulletin->apprenant?->notes as $note)
                        <tr>
                            <td>{{ $note->matiere?->nom_matiere ?? 'N/A' }}</td>
                            <td>{{ $note->type_evaluation }}</td>
                            <td>{{ $note->note }}/20</td>
                            <td>
                                @if($note->note >= 16)
                                    Excellent
                                @elseif($note->note >= 14)
                                    Très Bon
                                @elseif($note->note >= 12)
                                    Bon
                                @else
                                    Insuffisant
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Aucune note disponible.</p>
        @endif
    </div>

    <div style="margin-top: 40px; text-align: right;">
        <p>Signature de la Directrice</p>
        <p style="margin-top: 40px;">_________________</p>
        <p>Date: {{ now()->format('d/m/Y') }}</p>
    </div>
</body>
</html>
