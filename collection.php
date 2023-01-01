
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Collection</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <?php  include('includes/header.php') ?>
  <body>
    <main>
      <h1 class="titre">TOUS LES POKEMONS</h1>
      <?php
      include('includes/config.php');
      $q ='SELECT count(id) FROM pokemon';
      $req = $db->prepare($q);
      $req->execute();
      $idmax = $req->fetch();
      for ($id=1; $id <=$idmax[0];$id++) {
        $q ='SELECT * from pokemon where id = :id ';
        $req = $db->prepare($q);
        $req -> execute([
          'id' =>$id
        ]);
        $resultat = $req ->fetch();
        $img = $resultat['image'];
          echo "<div>";
          echo '<h4>'.$resultat['nom'].'</h4>';
          echo '<p> PV: '.$resultat['pv'].'</p>';
          echo '<p> Attaque: '.$resultat['defense'].'</p>';
          echo '<p> Défense: '.$resultat['defense'].'</p>';
          echo '<p> Vitesse: '.$resultat['vitesse'].'</p>';
          echo '</div>';
          echo "<div>";
          echo "<img src='uploads/$img' alt='photo pokemon' height='100px'";
          echo '</div>';
      }
       ?>
    </main>
    <footer>
    <?php  include('includes/footer.php') ?>
    </footer>
  </body>
</html>
