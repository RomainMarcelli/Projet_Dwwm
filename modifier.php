<?php


require('config/setting.php');

// Vérification si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


$username = $_SESSION['username'];
  // Récupération des informations du compte à modifier
  $data=$conn->prepare("SELECT * FROM users WHERE username=:i");
  $data->execute([":i" => "$username"]);
  $users= $data->fetch(PDO::FETCH_ASSOC);



if (!empty($_FILES['visuel']['name'])) {

  $uploadedFile = $_FILES['visuel'];

  // Déplacement de la nouvelle image avec le nom d'origine
  $uploadDir = 'images/';
  $fileName = $_FILES['visuel']['name'];
  $uploadFile = $uploadDir . $fileName;
  move_uploaded_file($uploadedFile['tmp_name'], $uploadFile);

  $visuel = $uploadFile; 
} else {
  $visuel = $users['image'];
}

if (!empty($_POST['password'])) {
  // Hasher le nouveau mot de passe
  $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

  // Mise à jour des informations dans la base de données
  $data = $conn->prepare('UPDATE users SET username = :u, password = :p, email = :e, couleur = :c, espece = :es, age = :g, image = :i, description = :d WHERE username = :a');
  $data->execute([
      ':a' => $username,
      ':u' => $_POST['name'],
      ':p' => $hashedPassword, // Utilisez le mot de passe hashé
      ':e' => $_POST['email'],
      ':c' => $_POST['couleur'],
      ':es' => $_POST['espece'],
      ':g' => $_POST['age'],
      ':i' => $visuel,
      ':d' => $_POST['description']
  ]);
} else {
  // Mise à jour des informations dans la base de données (sans modifier le mot de passe)
  $data = $conn->prepare('UPDATE users SET username = :u, email = :e, couleur = :c, espece = :s, age = :g, image = :i, description = :d WHERE username = :a');
  $data->execute([
      ':a' => $username,
      ':u' => $_POST['name'],
      ':e' => $_POST['email'],
      ':c' => $_POST['couleur'],
      ':s' => $_POST['espece'],
      ':g' => $_POST['age'],
      ':i' => $visuel,
      ':d' => $_POST['description']
  ]);
}

// Après avoir mis à jour le compte avec succès
$_SESSION['compte_modifie'] = true;

$_SESSION['username'] = $_POST['name'];
  // Redirection vers l'accueil
  header('Location: compte.php');
  exit;
} else {

  // Récupération des informations du jeu vidéo à modifier
  $data=$conn->prepare("SELECT * FROM users WHERE username=:i");
  $data->execute([":i" => "$username"]);
  $users= $data->fetch(PDO::FETCH_ASSOC);
}
