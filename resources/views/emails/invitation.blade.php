<!DOCTYPE html>
<html>
<head>
    <title>Invitation Tersea</title>
</head>
<body>
    <p>Bonjour,</p>
    <p>Vous avez été invité à rejoindre notre entreprise. Cliquez sur le lien ci-dessous pour valider votre invitation :</p>
    <a href="{{ url('/invitations/accept/'. $invitation->token) }}">Valider l'invitation</a>
    <p>Merci et bienvenue !</p>
</body>
</html>