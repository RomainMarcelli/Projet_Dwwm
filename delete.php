<?php require('config/setting.php');


// Vérifiez si l'utilisateur est connecté.
if (isset($_SESSION['username'])) {
    // Connexion à la base de données (à adapter selon votre configuration).
    $conn = new PDO('mysql:dbname='.SQL_NAME.';charset=utf8;host='.SQL_HOST , SQL_USER, SQL_PASS);

    // Obtenez l'ID de l'utilisateur connecté depuis la session.
    $username = $_SESSION['username'];

    // Requête SQL pour supprimer le compte de l'user.
    $sql = "DELETE FROM users WHERE username = :username";

    // Préparez la requête.
    $stmt = $conn->prepare($sql);

    // Liez l'ID de l'user à la requête.
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);

    // Exécutez la requête.
    if ($stmt->execute()) {
        // La suppression a réussi. Vous pouvez rediriger l'user vers une page de confirmation.
        session_destroy(); // Déconnectez l'user après la suppression.
        header('Location: confirm_supp.php');
        exit;
    } else {
        // La suppression a échoué. Gérez l'erreur ou redirigez l'user vers une page d'erreur.
        echo 'La suppression du compte a échoué.';
    }
} else {
    // L'user n'est pas connecté. Redirigez-le vers une page de connexion ou affichez un message d'erreur.
    echo 'Vous devez être connecté pour supprimer votre compte.';
}
?>

