<?php
require('config/setting.php');



$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$couleur = $_POST['couleur'];
$espece = $_POST['espece'];
$age = $_POST['age'];
$description = $_POST['description'];


if (!empty($_POST) && isset($name) && isset($email) && isset($_POST['password'])) {
    $req = $conn->query("SELECT username FROM `users` WHERE username='$name'");
    $chk_pseudo = $req->fetch(PDO::FETCH_ASSOC);
    if ($chk_pseudo == '1' || $chk_pseudo > '1') {
        $_SESSION['error_inscription'] = "Le nom d'utilisateur  " . $name . " est déjà utilisé.";
        header("Location: register.php");
    } else {
        $req = $conn->query("SELECT email FROM `users` WHERE email='$email'");
        $chk_mail = $req->fetch(PDO::FETCH_ASSOC);
        if ($chk_mail == '1' || $chk_mail > '1') {
            $_SESSION['error_inscription'] = "L'email " . $email . " est déjà utilisé.";
            header("Location: register.php");
        } else {
            $req = $conn->query("SELECT couleur FROM `couleur` WHERE couleur='$couleur'");
            $chk_couleur = $req->fetch(PDO::FETCH_ASSOC);
            if ($chk_couleur == '0') {
                $conn->query("INSERT INTO `couleur` (`couleur`) VALUES ('$couleur')");
            }

            $req = $conn->query("SELECT espece FROM `espece` WHERE espece='$espece'");
            $chk_espece = $req->fetch(PDO::FETCH_ASSOC);
            if ($chk_espece == '0') {
                $conn->query("INSERT INTO `espece` (`espece`) VALUES ('$espece')");
            }

            $req = $conn->query("SELECT age FROM `age` WHERE age='$age'");
            $chk_age = $req->fetch(PDO::FETCH_ASSOC);
            if ($chk_age == '0') {
                $conn->query("INSERT INTO `age` (`age`) VALUES ('$age')");
            }

            // Hasher le mot de passe
            $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $uploadedFile = $_FILES['visuel'];
            $uploadDir = 'images/';
            $fileName = $uploadDir . $_FILES['visuel']['name'];

            if (file_exists($fileName)) {
                unlink($fileName);
            }

            move_uploaded_file($uploadedFile['tmp_name'], $fileName);

            $insert = $conn->prepare('INSERT INTO users (username, password, email, couleur, espece, age, image, description) VALUES (:u, :p, :e, :c, :s, :g, :i, :d) ');
            $insert->execute([
                ':u' => $_POST['name'],
                ':p' => $hashedPassword, // Utilise le mot de passe hashé
                ':e' => $_POST['email'],
                ':c' => $_POST['couleur'],
                ':s' => $_POST['espece'],
                ':g' => $_POST['age'],
                ':i' => $fileName,
                ':d' => $_POST['description']
            ]);
            $_SESSION['username'] = $name;
            header("Location: connected.php");
        }
    }
}

