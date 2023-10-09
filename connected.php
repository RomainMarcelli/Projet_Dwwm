<?php require('config/setting.php');

if (empty($_SESSION['username'])) {
  header("Location: login.php");
} else {
?>
  <!DOCTYPE html>
  <html>

  <head>
    <?php include('partials/head.php') ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PetDer | retrouvé l'animal qui vous convient </title>
    <link rel="stylesheet" href="css/connected.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css"> -->
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
  </head>

  <body class="d-flex flex-column min-vh-100">
    <?php include('partials/header.php'); ?>
    <div class="tinder">
      <div class="tinder--status">
        <i class="fa fa-remove"></i>
        <i class="fa fa-heart"></i>
      </div>
      <?php



      $username = $_SESSION['username'];
      $couleurs = $conn->prepare("SELECT `couleur`, `espece`, `age` FROM `users` WHERE `username` LIKE '$username'");
      $couleurs->execute();
      $resultat = $couleurs->fetch(PDO::FETCH_ASSOC); // Récupérez la première ligne du résultat
      $couleur = $resultat['couleur']; // Stockez la couleur dans la variable $couleur
      $espece = $resultat['espece'];
      $age = $resultat['age'];
      $data = $conn->prepare("SELECT * FROM `users` WHERE `couleur` LIKE '$couleur' AND `espece` LIKE '$espece' AND `age` LIKE '$age' AND NOT username = '$username'");
      $data->execute();
      $socks = $data->fetchAll(PDO::FETCH_ASSOC);
      ?>
      <div class="tinder--cards">
        <?php
        foreach ($socks as $sock) :
          $ID_M = $sock['username'];
          $id_u = $conn->prepare("SELECT * FROM `paire` WHERE `ID_U` LIKE '$username' AND `ID_M` LIKE '$ID_M'");
          $id_u->execute();
          $id_us = $id_u->fetchAll(PDO::FETCH_ASSOC);
          // rajout !
          if (count($id_us) == 0) {
        ?>

            <div class="tinder--card overflow-auto" ID_M="<?= $sock['username']; ?>">
              <figure>
                <img src=<?= $sock['image'] ?> alt="#">
              </figure>
              <h3><?= $sock['username']; ?></h3>
              <?php if (!empty($sock['age']) || !empty($sock['couleur']) || !empty($sock['espece'])) : ?>
                <div class="info">
                  <?php if (!empty($sock['age'])) : ?>
                    <p><i class="fa-solid fa-ruler"></i><?= $sock['age']; ?></p>
                  <?php endif ?>
                  <?php if (!empty($sock['couleur'])) : ?>
                    <p class="color"><?= $sock['couleur']; ?></p>
                  <?php endif ?>
                  <?php if (!empty($sock['espece'])) : ?>
                    <p><?= $sock['espece']; ?></p>
                  <?php endif ?>
                </div>
                <?php if (!empty($sock['description'])) : ?>
                  <p class="description"><?= $sock['description']; ?></p>
                <?php endif ?>
              <?php endif ?>
            </div>

        <?php }
        endforeach; ?>
      </div>

      <div class="tinder--buttons">
        <button id="nope"><i class="fa fa-remove"></i></button>
        <button id="love"><i class="fa fa-heart"></i></button>
        <a href="delete.php" class="btn_supp" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce compte?');">Supprimer mon compte</a>

      </div>
    </div>


    <script src='https://hammerjs.github.io/dist/hammer.min.js'></script>
    <script src="js/card.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  </body>

  </html>
<?php } ?>