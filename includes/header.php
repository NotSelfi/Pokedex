<?php
session_start();
?>
<header >

         <img class="logo" src="images/logo.png" alt="Logo" >

  <nav>

          <div ><a href="index.php">Accueil</a> </div>
          <div ><a href="collection.php">Collection</a> </div>
          <div > <a href="add_pokemon.php">Ajouter un Pokemon</a> </div>



         <?php
          if(isset($_SESSION['email'])){
              echo ' <div> <a href="profile.php">Mon compte</a> </div> '  ;
             echo '  <div >  <a href="deconnexion.php">Deconnexion</a> </div> ' ;

          } else
            echo '  <div >  <a href="Connexion.php">Connexion</a> </div> ' ;

          ?>
  </nav>
</header>
