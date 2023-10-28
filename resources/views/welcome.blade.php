<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <title>Welcome to Our CRM</title>
</head>
<body>
    <div class="welcome-container">
        <div class="welcome-content">
            <h1>Welcome to Our CRM</h1>
            <img src="{{ asset('images/logo-tersea-light.svg') }}" alt="Company Logo">
            <p>Connectez-vous pour accéder à notre CRM</p>
            <a href="{{ route('login') }}" class="login-button">Se connecter</a>
        </div>
    </div>
</body>
</html>
