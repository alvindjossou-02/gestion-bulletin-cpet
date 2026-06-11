<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié - Gestion Bulletin CPET</title>
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
        .subtitle {
            color: #6B7280;
            font-size: 14px;
            line-height: 1.5;
        }
        .alert {
            background: #DBEAFE;
            border: 1px solid #BFDBFE;
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 20px;
            color: #1E40AF;
            font-size: 13px;
        }
        .alert-success {
            background: #DCFCE7;
            border: 1px solid #BBCF46;
            color: #166534;
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
        input {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #D1D5DB;
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
            transition: all 0.3s ease;
        }
        input:focus {
            outline: none;
            border-color: #0052CC;
            box-shadow: 0 0 0 3px rgba(0, 82, 204, 0.1);
        }
        .error {
            color: #DC2626;
            font-size: 13px;
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
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo-container">
                <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Logo" class="logo">
            </div>
            <h1>Mot de passe oublié</h1>
            <p class="subtitle">Pas de problème. Nous vous enverrons un lien pour réinitialiser votre mot de passe.</p>
        </div>

        <?php if(session('status')): ?>
            <div class="alert alert-success">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('password.email')); ?>">
            <?php echo csrf_field(); ?>

            <!-- Email Address -->
            <div class="form-group">
                <label for="email">Adresse email</label>
                <input id="email" type="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus>
                <?php if($errors->has('email')): ?>
                    <div class="error"><?php echo e($errors->first('email')); ?></div>
                <?php endif; ?>
            </div>

            <div class="button-group">
                <button type="submit">Envoyer le lien</button>
            </div>

            <div class="link-group">
                <a href="<?php echo e(route('login')); ?>">Retour à la connexion</a>
            </div>
        </form>
    </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\gestion-bulletin-cpet\resources\views/auth/forgot-password.blade.php ENDPATH**/ ?>