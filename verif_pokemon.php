<?php
session_start();

$nom = $_POST['nom'];
$pv = $_POST['pv'];
$atq = $_POST['attaque'];
$def = $_POST['defense'];
$vitesse =$_POST['vitesse'];

if(!isset($_SESSION['email'])){
    header('location: connexion.php?message=veuillez vous créer un compte :)');
    exit ;
}
if ( !isset($nom) || empty($nom) || !isset($pv)  || empty($pv) || !isset($atq)  || empty($atq) || !isset($def) || empty($def) || !isset($vitesse)  || empty($vitesse)) {
  header('location: add_pokemon.php?message=veuillez remplir toutes le données');
  exit;
}

if (!is_numeric($pv) || !is_numeric($atq) || !is_numeric($def) || !is_numeric($vitesse))  {
  header('location: add_pokemon.php?message=veuillez remplir les charactéristiques du pokemon avec des données numériques');
  exit;
}

if ($pv <0 || $atq <0 || $def <0 || $vitesse <0) {
  header('location: add_pokemon.php?message=veuillez remplir les charactéristiques du pokemon avec des données numériques supérieures à 0');
  exit;
}


include('includes/config.php');


$q ='SELECT nom from pokemon where nom = :nom';
$req = $db->prepare($q);
$req->execute([
  'nom' => $_POST['nom']
]);
$resultat = $req->fetch(PDO::FETCH_ASSOC);
if($resultat){
  header('location: add_pokemon.php?message=pokemon déjà ajouté au pokedex');
  exit;
}

if(isset($_FILES['image']) && !empty($_FILES['image']['name'])){

	$acceptable = [
		'image/jpeg',
		'image/png',
		'image/gif'
	];

	if(!in_array($_FILES['image']['type'], $acceptable)){
		header('location:add_pokemon.php?message=Format de fichier incorrect.');
		exit;
	}

	$maxSize = 2 * 1024 * 1024;
	if($_FILES['image']['size'] > $maxSize){
		header('location:add_pokemon.php?message=Le fichier est trop volumineux.');
		exit;
	}

  $path = 'uploads';
	if(!file_exists($path)){
		mkdir($path, 0777);
	}
	$filename = $_FILES['image']['name'];
  $array = explode('.',$filename);
  $ext = end($array);
  $filename ='image-'. time() . '.' . $ext;


	$destination = $path . '/' . $filename;
	move_uploaded_file($_FILES['image']['tmp_name'], $destination);
}

$q ='SELECT id from user where email = :email';
$req = $db->prepare($q);
$req->execute([
  'email' => $_SESSION['email']
]);
$id= $req->fetch();



$q = 'INSERT INTO pokemon (nom,pv,attaque,defense,vitesse,image, id_user) VALUES (:nom, :pv, :attaque, :defense, :vitesse, :image, :user)';
$req = $db->prepare($q);
$reponse = $req->execute([
  'nom' => $nom,
  'pv' => $pv,
  'attaque' => $atq,
  'defense' => $def,
  'vitesse' => $vitesse,
  'image' => $filename,
  'user' => $id['id']
]);


if (isset($reponse)) {
  header('location: profile.php?message=Pokemon créer avec succés');
  exit;
}
header('location: add_pokemon.php?message=erreur lors de la création du pokemon');
exit;

 ?>
