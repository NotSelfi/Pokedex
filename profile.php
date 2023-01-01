
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Mon profil</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">
  </head>
  <body >
    <?php
 include("includes/header.php");
  ?>
    <main class="center">

            <h1>MON COMPTE</h1>
      <div class="toto">
       <?php
       include("includes/config.php");
       $q ='SELECT * from user where email = :email ';
 $req = $db->prepare($q);
 $req -> execute([
 'email' =>$_SESSION['email']
]);


$resultat = $req ->fetch();

$pp = $resultat['image'];


?>
<div class="mesinfos">
        <h2>MES INFOS</h2>
        <h3>PSEUDO : <?php   echo $resultat['pseudo']; ?> </h3>
        <h3>EMAIL :  <?php   echo $resultat['email']; ?> </h3>
        <h3>IMAGE DE profil :  <?php        echo ""<img src="uploads/"'. $resultat['image'] . 'alt="Photo profil">; ?>  </h3>



  </div>
    <div class="mespokemons">   <h2>MES Pokemons</h2>

 <?php

         $q ='SELECT id from user where email = :nom';
         $req = $db->prepare($q);
         $req->execute([
         'nom' => $_SESSION['email']
         ]);

        $id= $req->fetch();
        $q ='SELECT count(id) FROM pokemon where id_user = :id ';
        $req = $db->prepare($q);

        $req->execute([
        'id' =>$id["id"]
        ]);
        $idmax = $req->fetch();
        if($idmax==0){
          echo "vous n'avez pas encore créer de Pokemons";
          exit ;
        }
       for ($i=1; $i <=$idmax[0];$i++) {
       $q ='SELECT * from pokemon where id_user = :id ';
       $req = $db->prepare($q);
       $req -> execute([
       'id' =>$id["id"]
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



  </div>
    </main>
    <?php
 include("includes/footer.php");
  ?>
</div>
  </body>
</html>
