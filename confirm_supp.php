<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/confirm_supp.css" />
    <link rel="shortcut icon" href="img/favicon.png" />
    <title>Confirmation de suppression</title>
</head>

<body>
    <header>
        <a class="logo" href="connected.php">PetDer</a>
    </header>
    <div>
        <div class="mid">
            <h1>Votre compte a été supprimé avec succès !</h1>
            <p>Vous allez être redirigé vers la page d'accueil.</p>
        </div>
    </div>
    <script>
        // Rediriger l'utilisateur vers la page d'accueil après quelques secondes
        setTimeout(function() {
            window.location.href = 'index.php';
        }, 3000); // Redirection après 3 secondes (ajustez la valeur selon vos besoins)
    </script>
</body>

</html>