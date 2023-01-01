<?php
if(isset($_POST['email']) && !empty($_POST['email'])){
	setcookie('email', $_POST['email'], time() + 3600);
}

if (!isset($_POST['email']) || empty($_POST['email']) ||!isset($_POST['password']) || empty($_POST['password'])) {
	header('location: connexion.php?message=Vous devez remplir les 3 champs. &type=danger');
	exit;
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	header('location: connexion.php?message=Email invalide. &type=danger');
	exit;
}

$mdp = $_POST['password'];
	if(strlen($mdp)<8){
		header('location: connexion.php?message=Mot de passe invalide:Veuillez saisir 8 caractères minimum. &type=danger');
		exit;
	}
	if (!preg_match('#[A-Z]#',$mdp) || !preg_match('#[a-z]#', $mdp) || !preg_match('#[0-9]#',$mdp)) {
		header('location: connexion.php?message=Mot de passe invalide : veuillez saisir au moins une majuscule, une minuscule et un nombre. &type=danger');
		exit;

	    }

include('includes/config.php');

$q = 'SELECT id FROM user WHERE email = :email';
$req = $db->prepare($q);
$req -> execute(['email' => $_POST['email']
]);

$resultat = $req ->fetch();

 if ($resultat) {
 	header('location: connexion.php?message=Adresse mail déjà utilisé.&type=danger');
	exit;
 }

 $q_p = 'SELECT id FROM user WHERE pseudo = :pseudo';
 $req_p = $db->prepare($q_p);
 $req_p -> execute(['pseudo' => $_POST['pseudo']
 ]);

 $resultat_p = $req_p ->fetch();

  if ($resultat_p) {
  	header('location: connexion.php?message=Pseudo déjà utilisé.&type=danger');
 	exit;
  }


if(isset($_FILES['image']) && !empty($_FILES['image']['name'])){


		$acceptable = [
			'image/jpeg',
			'image/png',
			'image/gif'
		];

		if(!in_array($_FILES['image']['type'], $acceptable)){
			header("location: connexion.php?message=Format de fichier incorrect. ");
		exit;
		}


		$maxSize = 2 * 1024 * 1024;

		if($_FILES['image']['size'] > $maxSize ){
			header("location: connexion.php?message=le fichier est trop volumineux.");
		exit;
		}

		$path = 'uploads';


		if (!file_exists($path)) {
			mkdir($path, 0777);
		}
		$filename = $_FILES['image']['name'];



		$array = explode('.',$filename);
		$ext = end($array);
		$filename= 'image-'.time().'.'. $ext;

		$destination = $path . '/' . $_FILES['image']['name'];
		move_uploaded_file($_FILES['image']['tmp_name'], $destination);
}




$q = 'INSERT INTO user (pseudo,email, password, image) VALUES(:pseudo, :email, :password, :image)';
$req = $db->prepare($q);
$reponse = $req ->execute([
	'pseudo' => $_POST['pseudo'],
	'email' => $_POST['email'],
	'password' => hash('sha512', $_POST['password']),
'image'=> isset($filename) ? $filename :'']);



if(!$reponse){
	header("location: connexion.php?message=erreur lors de l'inscription");
	exit;
}else {
	header("location: connexion.php?message=Compte crée avec un succés.");
	exit;
}
