<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accès Refusé - CPET</title>
    @vite(['resources/css/app.css'])
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);
            font-family: 'Figtree', sans-serif;
            color: #333;
        }
        .error-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            padding: 60px 40px;
            text-align: center;
            max-width: 600px;
            margin: 20px;
        }
        .error-code {
            font-size: 120px;
            font-weight: 900;
            color: #F59E0B;
            margin: 0;
            line-height: 1;
        }
        .error-title {
            font-size: 32px;
            font-weight: 600;
            color: #333;
            margin: 20px 0 10px 0;
        }
        .error-message {
            font-size: 16px;
            color: #666;
            margin: 10px 0 30px 0;
            line-height: 1.6;
        }
        .error-icon {
            font-size: 80px;
            margin-bottom: 20px;
        }
        .btn-home {
            display: inline-block;
            padding: 12px 32px;
            background: linear-gradient(135deg, #0052CC 0%, #003D99 100%);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-right: 10px;
        }
        .btn-home:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 82, 204, 0.3);
        }
        .btn-back {
            display: inline-block;
            padding: 12px 32px;
            background: #f0f0f0;
            color: #333;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: background 0.3s ease;
        }
        .btn-back:hover {
            background: #e0e0e0;
        }
        .footer-text {
            margin-top: 40px;
            font-size: 14px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-icon">🔒</div>
        <h1 class="error-code">403</h1>
        <h2 class="error-title">Accès Refusé</h2>
        <p class="error-message">
            Vous n'avez pas la permission d'accéder à cette ressource. Si vous pensez qu'il s'agit d'une erreur, veuillez contacter votre administrateur.
        </p>
        <div>
            <a href="{{ route('dashboard') }}" class="btn-home">Retour au Tableau de Bord</a>
            <a href="javascript:history.back()" class="btn-back">Retour Précédent</a>
        </div>
        <p class="footer-text">
            Code d'erreur: <strong>403 - Forbidden</strong>
        </p>
    </div>
</body>
</html>
