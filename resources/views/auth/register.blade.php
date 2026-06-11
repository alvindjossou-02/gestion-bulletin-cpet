<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'inscrire - Gestion Bulletin CPET</title>
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
            margin-bottom: 8px;
        }
        .subtitle {
            color: #6B7280;
            font-size: 14px;
        }
        .form-group {
            margin-bottom: 18px;
        }
        label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
        }
        input, select {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #D1D5DB;
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
            transition: all 0.3s ease;
        }
        input:focus, select:focus {
            outline: none;
            border-color: #0052CC;
            box-shadow: 0 0 0 3px rgba(0, 82, 204, 0.1);
        }
        .error {
            color: #DC2626;
            font-size: 13px;
            margin-top: 6px;
        }
        .helper-text {
            color: #6B7280;
            font-size: 12px;
            margin-top: 6px;
        }
        .button-group {
            display: flex;
            gap: 12px;
            margin-top: 28px;
        }
        button {
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
        }
        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 82, 204, 0.25);
        }
        .link-group {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }
        .link-group a {
            color: #0052CC;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        .link-group a:hover {
            color: #003D99;
        }
        .divider {
            color: #D1D5DB;
            margin: 0 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo-container">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
            </div>
            <h1>Créer un compte apprenant</h1>
            <p class="subtitle">Inscrivez-vous pour accéder à vos notes et bulletins</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="form-group">
                <label for="name">Nom complet</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
                @if ($errors->has('name'))
                    <div class="error">{{ $errors->first('name') }}</div>
                @endif
            </div>

            <!-- Email Address -->
            <div class="form-group">
                <label for="email">Adresse email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                @if ($errors->has('email'))
                    <div class="error">{{ $errors->first('email') }}</div>
                @endif
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input id="password" type="password" name="password" required>
                @if ($errors->has('password'))
                    <div class="error">{{ $errors->first('password') }}</div>
                @endif
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation">Confirmer le mot de passe</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required>
                @if ($errors->has('password_confirmation'))
                    <div class="error">{{ $errors->first('password_confirmation') }}</div>
                @endif
            </div>

            <!-- Role Selection -->
            <div class="form-group">
                <label for="role">Rôle</label>
                <select id="role" name="role" required>
                    <option value="apprenant" {{ old('role', 'apprenant') === 'apprenant' ? 'selected' : '' }}>Apprenant</option>
                </select>
                <p class="helper-text">Vous vous inscrivez en tant qu'apprenant.</p>
                @if ($errors->has('role'))
                    <div class="error">{{ $errors->first('role') }}</div>
                @endif
            </div>

            <div class="button-group">
                <button type="submit">S'inscrire</button>
            </div>

            <div class="link-group">
                Déjà inscrit? <a href="{{ route('login') }}">Se connecter</a>
            </div>
        </form>
    </div>
</body>
</html>
