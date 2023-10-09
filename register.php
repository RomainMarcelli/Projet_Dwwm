<?php
require('config/setting.php');


?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/register.css" />
  <link rel="shortcut icon" href="img/favicon.png" />
  <link rel="stylesheet" href="css/style.css" />

  <title>PetDer | retrouvé l'animal qui vous convient </title>
</head>

<body>
  <div class="screen">
    <div class="form-container">
      <div class="form-content">
        <h2><a href="./index.php">PetDer</a></h2>
        <h3>Créer votre compte</h3>
        <p>
          Nous avons besoin de vos informations pour trouver le bon animal
        </p>
        <?php
        if (isset($_SESSION['error_inscription'])) { ?>
          <p>
            <?php echo $_SESSION['error_inscription']; ?>
          </p>
        <?php } ?>
        <form action="inscription.php" method="POST"  enctype="multipart/form-data">
          <h3>Dites nous en plus à propos de vous</h3>
          <div class="main-informations">
            <label for="name">
              <input type="text" id="name" placeholder="Pseudo" name="name" required />
            </label>
            <label for="email">
              <input type="email" id="email" placeholder="Mail" name="email" required />
            </label>
            <label for="password">
              <input type="password" id="password" placeholder="Mot de passe" name="password" required />
            </label>
            <label for="description">
              <input type="text" id="description" placeholder="Description" name="description" required />
            </label> <br>
             <label for="visuel">  <h4>Photo de profil :</h4></label>
            <input  type="file" class="form-control" id="visuel" name="visuel" required />
          </div>

     
           
          

          <h4>Couleur :</h4>
          <div class="hobbies radio" id="couleurContainer">
            <?php
            $data = $conn->prepare('SELECT * FROM couleur');
            $data->execute();
            $couleurs = $data->fetchAll(PDO::FETCH_ASSOC);

            foreach ($couleurs as $couleur):
              ?>
              <div>
                <label for="<?= $couleur['couleur']; ?>">
                  <input id="<?= $couleur['couleur']; ?>" type="radio" name="couleur" value="<?= $couleur['couleur']; ?>"
                    required />
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

          <h4>Espèce :</h4>
          <div class="hobbies radio" id="especeContainer">
            <?php
            $data = $conn->prepare('SELECT * FROM espece');
            $data->execute();
            $especes = $data->fetchAll(PDO::FETCH_ASSOC);

            foreach ($especes as $espece):
              ?>
              <div>
                <label for="<?= $espece['espece']; ?>">
                  <input id="<?= $espece['espece']; ?>" type="radio" name="espece" value="<?= $espece['espece']; ?>"
                    required />
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

            foreach ($ages as $age):
              ?>
              <div>
                <label for="<?= $age['age']; ?>">
                  <input id="<?= $age['age']; ?>" type="radio" name="age" value="<?= $age['age']; ?>"
                    required />
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




          <input class="btn-login" type="submit" value="Inscription" />
        </form>





        <p>
          Vous avez déjà un compte ?
          <a href="login.php">Connexion</a>
        </p>
      </div>
    </div>
  </div>
</body>
<script src="./js/compte.js"></script>


</html>