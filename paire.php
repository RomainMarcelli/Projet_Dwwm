<?php require('config/setting.php');

if (empty($_SESSION['username'])) {
  header("Location: login.php");
} else {
?>
  <!DOCTYPE html>
  <html>


  <head>
    <?php include('partials/head.php') ?>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/paire.css" />
    <link rel="shortcut icon" href="img/favicon.png" />
    <link rel="stylesheet" href="css/style.css" />

    <title>PetDer | retrouvé l'animal qui vous convient </title>
  </head>

  <body class="d-flex flex-column min-vh-100">
    <?php include('partials/header.php'); ?>

    <div class="screen">

      <div class="form-container">
        <div class="form-content">
          <div class="petder">
            <a class="logo" href="connected.php">PetDer</a>
            <ul class="links">
              <a href=".?logout" class="secondary-button">Se déconnecter</a>
              <a href="compte.php" class="secondary-button" style="margin: 11px;"><i class="fa-solid fa-user"></i></a>
              <a href="paire.php" class="secondary-button" style="margin: 11px;"> <i class="fa-solid fa-heart"></i></a>
            </ul>
          </div>
          <?php $username = $_SESSION['username']; ?>

          <h3><?= $username; ?></h3>

          <p>Les animaux avec qui vous correspondez :</p>
          <section id="container--match">
            <!-- recuperer toutes les paires qui nous ont like -->
            <?php $data = $conn->prepare("SELECT * FROM paire WHERE ID_M=:i");
            $data->execute([
              ":i" => "$username"
            ]);
            $users = $data->fetchAll(PDO::FETCH_ASSOC);
            // pour chaque pair qui a like l'user verifier si nous on la like
            foreach ($users as $user) { ?><?php
                                          $dataPairs = $conn->prepare("SELECT * FROM paire WHERE ID_U=:y AND ID_M=:i");
                                          $dataPairs->execute([
                                            ':y' => $username,
                                            ':i' => $user['ID_U']
                                          ]);
                                          $pairs = $dataPairs->fetchAll(PDO::FETCH_ASSOC); ?>
            <?php
              if (!empty($pairs)) :
                $dataPair = $conn->prepare("SELECT * FROM users WHERE username=:i");
                $dataPair->execute([
                  ':i' => $pairs[0]['ID_M']
                ]);
                $pair = $dataPair->fetch(PDO::FETCH_ASSOC); ?>
              <article class="card--match">
                <figure>
                  <img src=<?= $pair['image'] ?> alt="#">
                </figure>
                <div>
                  <h4><?= $pair['username'] ?></h4>
                  <ul>
                    <li><?= $pair['age'] ?></li>
                    <li><?= $pair['espece'] ?></li>
                    <li><?= $pair['couleur'] ?></li>
                  </ul>

                </div>

              </article>
            <?php endif
            ?>


          <?php  }

          ?>
          </section>
          <div class="low_links">
            <a href=".?logout" class="secondary-button" id="resp">Se déconnecter</a>
            <a href="compte.php" class="secondary-button" id="resp" style="margin: 11px;"><i class="fa-solid fa-user"></i></a>
            <a href="paire.php" class="secondary-button" id="resp" style="margin: 11px;"> <i class="fa-solid fa-heart"></i></a>
          </div>

        </div>
      </div>
  </body>


  <script src='https://hammerjs.github.io/dist/hammer.min.js'></script>

  </body>

  </html>
<?php } ?>