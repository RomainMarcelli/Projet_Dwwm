<header class="navbar" id="navbar">

  <a class="logo" href="connected.php">PetDer</a>
  <div class="links-navbar">
    <ul>
      <?php if (isset($_SESSION['username']) && $_SESSION['username'] !== null) : ?>
        <a href="compte.php" class="secondary-button"><i class="fa-solid fa-user"></i></a>
        <a href="paire.php" class="secondary-button"> <i class="fa-solid fa-heart"></i></a>
        <a href=".?logout" class="secondary-button">Se déconnecter</a>
        <a href="delete.php" class="secondary-button" id="second_supp" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce compte?');">Supprimer mon compte</a>


      <?php else : ?>
        <a href="login.php" class="secondary-button">Se connecter</a>
      <?php endif; ?>
      <!-- <a href="login.php" class="secondary-button">Connexion</a> -->
      </li>
    </ul>

    <div id="root">
      <div id="topnav" class="topnav">


        <!-- Classic Menu -->

        <a id="topnav_hamburger_icon" href="javascript:void(0);" onclick="showResponsiveMenu()">
          <!-- Some spans to act as a hamburger -->
          <span></span>
          <span></span>
          <span></span>
        </a>

        <!-- Responsive Menu -->
        <nav role="navigation" id="topnav_responsive_menu">
          <ul>
            <li><a href="delete.php" class="secondary-button" id="btn_supp" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce compte?');">Supprimer mon compte</a></li>
            <li><a href=".?logout" class="secondary-button">Se déconnecter</a></li>
            <li><a href="compte.php" class="secondary-button"><i class="fa-solid fa-user"></i></a></li>
            <li><a href="paire.php" class="secondary-button"> <i class="fa-solid fa-heart"></i></a></li>
          </ul>
        </nav>
      </div>
    </div>
    <!-- <div class="menu-hamburger">
        <div class="button-burger-menu"></div> -->
    <!-- </div> -->

</header>