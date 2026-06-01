<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Connexion - Gestion Bulletin CPET</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --color-primary: #0052CC;
            --color-primary-dark: #003D99;
            --color-accent: #20C997;
            --color-gray-50: #FAFAFA;
            --color-gray-100: #F3F4F6;
            --color-gray-200: #E5E7EB;
            --color-gray-300: #D1D5DB;
            --color-gray-600: #4B5563;
            --color-gray-700: #374151;
            --color-gray-900: #111827;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Figtree', sans-serif;
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--color-gray-900);
        }

        .login-container {
            width: 100%;
            max-width: 420px;
            padding: 20px;
        }

        .login-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        .login-header {
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-accent) 100%);
            padding: 40px 24px;
            text-align: center;
        }

        .login-logo {
            width: 60px;
            height: 60px;
            margin: 0 auto 16px;
            border-radius: 8px;
            object-fit: cover;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .login-title {
            color: white;
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .login-subtitle {
            color: rgba(255, 255, 255, 0.8);
            font-size: 14px;
        }

        .login-body {
            padding: 32px 24px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: var(--color-gray-700);
            margin-bottom: 8px;
        }

        .form-input,
        .form-input-wrapper {
            display: block;
            width: 100%;
            padding: 10px 14px;
            font-size: 14px;
            border: 1px solid var(--color-gray-300);
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .form-input-wrapper {
            display: flex;
            align-items: center;
            padding: 0;
            border: 1px solid var(--color-gray-300);
        }

        .form-input {
            border: none;
            padding: 10px 14px;
            flex: 1;
        }

        .form-input:focus,
        .form-input-wrapper:has(.form-input:focus) {
            outline: none;
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px rgba(0, 82, 204, 0.1);
        }

        .password-toggle {
            background: none;
            border: none;
            cursor: pointer;
            padding: 10px 14px;
            color: var(--color-gray-600);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: var(--color-primary);
        }

        .password-toggle svg {
            width: 18px;
            height: 18px;
        }

        .form-error {
            margin-top: 4px;
            font-size: 13px;
            color: #DC2626;
        }

        .form-checkbox {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: var(--color-gray-700);
            margin-bottom: 24px;
        }

        .form-checkbox input {
            width: 16px;
            height: 16px;
            cursor: pointer;
            accent-color: var(--color-primary);
        }

        .form-checkbox label {
            cursor: pointer;
            user-select: none;
        }

        .form-submit {
            width: 100%;
            padding: 12px;
            font-size: 14px;
            font-weight: 600;
            color: white;
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 16px;
        }

        .form-submit:hover {
            box-shadow: 0 8px 20px rgba(0, 82, 204, 0.3);
            transform: translateY(-2px);
        }

        .form-submit:active {
            transform: translateY(0);
        }

        .form-link {
            display: block;
            text-align: center;
            font-size: 14px;
            color: var(--color-primary);
            text-decoration: none;
            transition: color 0.3s ease;
            margin-bottom: 8px;
        }

        .form-link:hover {
            color: var(--color-primary-dark);
        }

        .login-footer {
            padding: 20px 24px;
            background: var(--color-gray-50);
            text-align: center;
            font-size: 14px;
            color: var(--color-gray-600);
            border-top: 1px solid var(--color-gray-200);
        }

        .login-footer a {
            color: var(--color-primary);
            text-decoration: none;
            font-weight: 600;
        }

        .login-footer a:hover {
            text-decoration: underline;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .alert-error {
            background-color: #FEE2E2;
            color: #991B1B;
            border: 1px solid #FECACA;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 10px;
            }

            .login-body {
                padding: 24px 16px;
            }

            .login-header {
                padding: 30px 16px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <!-- Header -->
            <div class="login-header">
                <img src="{{ asset('images/logo.png') }}" alt="Logo CPET" class="login-logo">
                <h1 class="login-title">Connexion</h1>
                <p class="login-subtitle">Gestion Bulletin CPET</p>
            </div>

            <!-- Body -->
            <div class="login-body">
                @if ($errors->any())
                    <div class="alert alert-error">
                        <strong>Erreur :</strong> Email ou mot de passe incorrect.
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input 
                            id="email" 
                            type="email" 
                            name="email" 
                            class="form-input" 
                            value="{{ old('email') }}"
                            required 
                            autofocus
                            placeholder="votre@email.com"
                        >
                        @error('email')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password" class="form-label">Mot de passe</label>
                        <div class="form-input-wrapper">
                            <input 
                                id="password" 
                                type="password" 
                                name="password" 
                                class="form-input" 
                                required
                                placeholder="••••••••"
                            >
                            <button type="button" class="password-toggle" id="togglePassword">
                                <svg id="eyeIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="form-checkbox">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Se souvenir de moi</label>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="form-submit">Connexion</button>

                    <!-- Footer Links -->
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="form-link">Mot de passe oublié ?</a>
                    @endif
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="form-link">Créer un compte</a>
                    @endif
                </form>
            </div>

            <!-- Footer -->
            <div class="login-footer">
                © 2026 <strong>Gestion Bulletin CPET</strong>
            </div>
        </div>
    </div>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        togglePassword.addEventListener('click', () => {
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            
            // Update icon
            if (isPassword) {
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>';
            } else {
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>';
            }
        });
    </script>
</body>
</html>
