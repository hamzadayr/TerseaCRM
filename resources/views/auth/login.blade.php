<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>Connexion à Notre CRM</title>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <img src="{{ asset('images/logo-tersea-light.svg') }}" alt="Tersea Logo">
            <h2>Connexion à Notre CRM</h2>
            <form method="POST" action="{{ route('login') }}">
             @csrf
                <div class="form-group">
                     <input type="email" name="email" placeholder="Adresse e-mail" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Mot de passe" required>
                </div>
                @if (session('error'))
                <div class="error-message">
                    {{ session('error') }}
                </div>
                @endif
                <button type="submit">Se connecter</button>
            </form>
        </div>
    </div>
</body>
</html>
