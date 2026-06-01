<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérifier l'email - Gestion Bulletin CPET</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #0052CC 0%, #003D99 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 82, 204, 0.15);
            width: 100%;
            max-width: 420px;
            padding: 40px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .logo {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            object-fit: cover;
        }
        h1 {
            font-size: 24px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 12px;
        }
        .message {
            color: #6B7280;
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 20px;
        }
        .alert {
            background: #DCFCE7;
            border: 1px solid #86EFAC;
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 20px;
            color: #166534;
            font-size: 13px;
        }
        .button-group {
            display: flex;
            gap: 12px;
            margin-top: 28px;
        }
        button, .button-link {
            flex: 1;
            padding: 10px 16px;
            background: linear-gradient(135deg, #0052CC 0%, #003D99 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        button:hover, .button-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 82, 204, 0.25);
        }
        .logout-button {
            background: #EF4444;
        }
        .logout-button:hover {
            box-shadow: 0 8px 20px rgba(239, 68, 68, 0.25);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo-container">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
            </div>
            <h1>Vérifier l'email</h1>
        </div>

        <p class="message">
            Merci de vous être inscrit! Avant de commencer, pourriez-vous vérifier votre adresse email en cliquant sur le lien que nous avons envoyé?
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="alert">
                Un nouveau lien de vérification a été envoyé à l'adresse email que vous avez fournie.
            </div>
        @endif

        <div class="button-group">
            <form method="POST" action="{{ route('verification.send') }}" style="flex: 1;">
                @csrf
                <button type="submit" style="width: 100%;">
                    Renvoyer l'email
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}" style="flex: 1;">
                @csrf
                <button type="submit" class="logout-button" style="width: 100%;">
                    Se déconnecter
                </button>
            </form>
        </div>
    </div>
</body>
</html>
</x-guest-layout>
