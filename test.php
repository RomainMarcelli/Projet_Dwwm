<?php
session_start();

// Vérifiez si l'utilisateur est connecté.
if (!isset($_SESSION['username'])) {
    // Redirigez vers une page de connexion ou affichez un message d'erreur.
    header("Location: login.php");
    exit;
}

// Vérifiez si le formulaire de suppression a été soumis.
if (isset($_POST['supprimer_compte'])) {
    // Placez ici la logique de suppression du compte de l'utilisateur actuellement connecté.
    // Vous devez utiliser une requête SQL avec une clause WHERE pour cibler l'utilisateur connecté.
    
    // Exemple de requête SQL pour supprimer l'utilisateur actuellement connecté :
    $username = $_SESSION['username'];
    $sql = "DELETE FROM utilisateurs WHERE username = :username";
    
    // Préparez la requête.
    $stmt = $pdo->prepare($sql);
    
    // Liez le nom d'utilisateur à la requête.
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    
    // Exécutez la requête.
    if ($stmt->execute()) {
        // La suppression a réussi. Vous pouvez rediriger l'utilisateur vers une page de confirmation.
        session_destroy(); // Déconnectez l'utilisateur après la suppression.
        header("Location: confirmation_suppression.php");
        exit;
    } else {
        // La suppression a échoué. Gérez l'erreur ou redirigez l'utilisateur vers une page d'erreur.
        echo 'La suppression du compte a échoué.';
    }
}

// Si le formulaire n'a pas été soumis, redirigez l'utilisateur vers la page de profil.
header("Location: profil.php");
exit;
?>
