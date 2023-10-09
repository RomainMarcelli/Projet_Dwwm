<?php require('config/setting.php');

if (empty($_SESSION['username'])) {
  header("Location: login.php");
} else {
?>
  <!DOCTYPE html>
  <html>


  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/compte.css" />
    <link rel="shortcut icon" href="img/favicon.png" />
    <!-- <link rel="stylesheet" href="css/style.css"/> -->
    <link rel="shortcut icon" href="img/favicon.png" />
    <link rel="stylesheet" href="css/all.min.css">
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
              <a href="compte.php" class="secondary-button" style="margin: 11px;"><i class="fa-solid fa-user"></i></a>
              <a href="paire.php" class="secondary-button" style="margin: 11px;"> <i class="fa-solid fa-heart"></i></a>
              <a href=".?logout" class="secondary-button">Se déconnecter</a>
              <a href="delete.php" class="btn_supp" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce compte?');">Supprimer mon compte</a>
            </ul>
          </div>
          <h2>Mon compte</h2>

          <?php $username = $_SESSION['username']; ?>


          <section id="container--match">
            <!-- recuperer toutes les paires qui nous ont like -->
            <?php $data = $conn->prepare("SELECT * FROM users WHERE username=:y");
            $data->execute([
              ":y" => "$username"
            ]);
            $users = $data->fetch(PDO::FETCH_ASSOC);
            ?>



            <h3>Modifier votre compte</h3>
            <?php
              // Vérifie si la variable de session existe et affiche un message si c'est le cas
              if (isset($_SESSION['compte_modifie']) && $_SESSION['compte_modifie']) {
                echo '<p>Le compte a été modifié avec succès.</p>';

                // Supprime la variable de session pour ne pas afficher le message à nouveau
                unset($_SESSION['compte_modifie']);
              }
              ?>

            <?php
            if (isset($_SESSION['error_inscription'])) { ?>
              <p>
                <?php echo $_SESSION['error_inscription']; ?>
              </p>
            <?php } ?>
            <form action="modifier.php" method="POST" enctype="multipart/form-data">
              <h3>Modifier vos informations personnel</h3>
              <div class="main-informations">
                <label for="name">
                  <input type="text" id="name" placeholder="Pseudo" value="<?= $users['username'] ?>" name="name" required />
                </label>
                <label for="email">
                  <input type="email" id="email" placeholder="Mail" value="<?= $users['email'] ?>" name="email" required />
                </label>
                <label for="password">
                  <input type="password" id="password" placeholder="Mot de passe" name="password" />
                </label>
                <label for="description">
                  <input type="text" id="description" value="<?= $users['description'] ?>" placeholder="Description" name="description" required />
                </label> <br>

                <label for="visuel">
                  <h4>Photo de profil :</h4>
                </label>
                <div style=" display: flex; column-gap: 20px;  width: 80%;
    margin-left: 10%; align-items: center;">
                  <figure>
                    <img style="
    border-radius: 20px; max-width: 100px;
" src=<?= $users['image'] ?> alt="#">
                  </figure>
                  <input style=" height: 10%;" type="file" class="form-control" id="visuel" name="visuel" />
                </div>
              </div>





              <h4>Couleur :</h4>
              <div class="hobbies radio" id="couleurContainer">
                <?php
                $data = $conn->prepare('SELECT * FROM couleur');
                $data->execute();
                $couleurs = $data->fetchAll(PDO::FETCH_ASSOC);

                foreach ($couleurs as $couleur) :
                ?>
                  <div>
                    <label for="<?= $couleur['couleur']; ?>">
                      <input id="<?= $couleur['couleur']; ?>" type="radio" name="couleur" <?php if ($couleur['couleur'] == $users['couleur']) { ?> checked <?php }; ?> value="<?= $couleur['couleur']; ?>" required />
                      <span>
                        <?= $couleur['couleur']; ?>
                      </span>
                    </label>
                  </div>
                <?php endforeach; ?>
              </div>
              <div>
                <div class="newColor">
                  <label for="newColor">
                    <input type="text" id="newColor" class="newC" placeholder="Ajoutez" name="newColor" />
                  </label>
                  <button type="button" class="newColorb" onclick="ajouterCouleur()">+</button>
                </div>
              </div>

              <h4>Espèces :</h4>
              <div class="hobbies radio" id="especeContainer">
                <?php
                $data = $conn->prepare('SELECT * FROM espece');
                $data->execute();
                $especes = $data->fetchAll(PDO::FETCH_ASSOC);

                foreach ($especes as $espece) :
                ?>
                  <div>
                    <label for="<?= $espece['espece']; ?>">
                      <input id="<?= $espece['espece']; ?>" <?php if ($espece['espece'] == $users['espece']) { ?> checked <?php }; ?> type="radio" name="espece" value="<?= $espece['espece']; ?>" required />
                      <span>
                        <?= $espece['espece']; ?>
                      </span>
                    </label>
                  </div>
                <?php endforeach; ?>
              </div>

              <div class="newColor">
                <label for="newEspece">
                  <input type="text" id="newEspece" class="newC" placeholder="Ajoutez" name="newEspece" />
                </label>
                <button type="button" class="newColorb" onclick="ajouterEspece()">+</button>
              </div>



              <h4>Âge :</h4>
              <div class="hobbies radio" id="ageContainer">
                <?php
                $data = $conn->prepare('SELECT * FROM age');
                $data->execute();
                $ages = $data->fetchAll(PDO::FETCH_ASSOC);

                foreach ($ages as $age) :
                ?>
                  <div>
                    <label for="<?= $age['age']; ?>">
                      <input id="<?= $age['age']; ?>" <?php if ($age['age'] == $users['age']) { ?> checked <?php }; ?> type="radio" name="age" value="<?= $age['age']; ?>" required />
                      <span>
                        <?= $age['age']; ?>
                      </span>
                    </label>
                  </div>
                <?php endforeach; ?>
              </div>

              <div class="newColor">
                <label for="newAge">
                  <input type="text" id="newAge" class="newC" placeholder="Ajoutez" name="newAge" />
                </label>
                <button type="button" class="newColorb" onclick="ajouterAge()">+</button>
              </div>




              <input class="btn-login" type="submit" value="Modifier" />
            </form>

            <a href=".?logout" class="secondary-button" id="resp">Se déconnecter</a>
            <a href="compte.php" class="secondary-button" id="resp" style="margin: 11px;"><i class="fa-solid fa-user"></i></a>
            <a href="paire.php" class="secondary-button" id="resp" style="margin: 11px;"> <i class="fa-solid fa-heart"></i></a>
            <a href="delete.php" class="btn_supp" id="resp" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce compte?');">Supprimer mon compte</a>

        </div>
      </div>
    </div>
  </body>
  <script src="./js/compte.js"></script>

  </html>
<?php } ?>