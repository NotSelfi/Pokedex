
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>ajouter un pokemon</title>
    <link rel="stylesheet" href="css/style.css">
  </head>

  <?php  include('includes/header.php') ;
 ?>

  <body>
    <main>
      <h1 class="titre">AJOUTER UN POKEMON</h1>
      <?php include('includes/message.php') ?>
        <div id="add_pokemon">

      <form action="verif_pokemon.php" method="post" enctype="multipart/form-data">
        <div class="">
          <input type="text" name="nom" placeholder="Nom">
        </div>
        <div class="">
          <input type="number" name="pv" placeholder="PV">
        </div>
        <div class="">
          <input type="number" name="attaque" placeholder="Attaque">
        </div>
        <div class="">
          <input type="number" name="defense" placeholder="Défense">
        </div>
        <div class="">
          <input type="number" name="vitesse" placeholder="Vitesse">
        </div>
        <div class="">
          <label> Image : </label>
          <input class="file" type="file" name="image" accept="image/jpeg, image/gif, image/png, image/jpg">
        </div>
        <div>
          <input class="btn-ajt" type="submit" value="AJOUTER">
        </div>
      </form>
    </div>
    </main>
    <footer>
      <?php include('includes/footer.php') ?>
    </footer>
  </body>
</html>
