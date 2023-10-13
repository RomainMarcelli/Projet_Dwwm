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
                <div class="description">
                  <div>
                    <h4><?= $pair['username'] ?></h4>
                    <ul>
                      <li><?= $pair['age'] ?></li>
                      <li><?= $pair['espece'] ?></li>
                      <li><?= $pair['couleur'] ?></li>
                    </ul>

                  </div>
                  
                  <script>
                    function deletePair(element) {
                      var pairId = element.getAttribute("data-id");

                      if (confirm('Êtes-vous sûr de vouloir supprimer cette paire ?')) {
                        $.ajax({
                          type: 'POST', // Utilisez POST ou GET selon votre implémentation côté serveur.
                          url: 'supprimer_paire.php', // L'URL pour le script PHP de suppression.
                          data: {
                            pairId: pairId
                          },
                          success: function(response) {
                            // Gérer la réponse du serveur, par exemple, actualiser la page.
                            location.reload();
                          },
                          error: function() {
                            alert('Une erreur s\'est produite lors de la suppression de la paire.');
                          }
                        });
                      }
                    }
                  </script>
                  
                  <a href="supprimer_paire.php" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet animal ?');">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512">
                      <path d="M376.6 84.5c11.3-13.6 9.5-33.8-4.1-45.1s-33.8-9.5-45.1 4.1L192 206 56.6 43.5C45.3 29.9 25.1 28.1 11.5 39.4S-3.9 70.9 7.4 84.5L150.3 256 7.4 427.5c-11.3 13.6-9.5 33.8 4.1 45.1s33.8 9.5 45.1-4.1L192 306 327.4 468.5c11.3 13.6 31.5 15.4 45.1 4.1s15.4-31.5 4.1-45.1L233.7 256 376.6 84.5z" />
                    </svg>
                  </a>
                  <!-- <a href="#" data-id="<?= $pair['ID'] ?>" onclick="deletePair(); return false;">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512">
                      <path d="M376.6 84.5c11.3-13.6 9.5-33.8-4.1-45.1s-33.8-9.5-45.1 4.1L192 206 56.6 43.5C45.3 29.9 25.1 28.1 11.5 39.4S-3.9 70.9 7.4 84.5L150.3 256 7.4 427.5c-11.3 13.6-9.5 33.8 4.1 45.1s33.8 9.5 45.1-4.1L192 306 327.4 468.5c11.3 13.6 31.5 15.4 45.1 4.1s15.4-31.5 4.1-45.1L233.7 256 376.6 84.5z" />
                    </svg>
                  </a> -->


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