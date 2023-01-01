<?php
if(isset($_POST['email']) && !empty($_POST['email'])){
	setcookie('email', $_POST['email'], time() + 3600);
}
if (!isset($_POST['email']) || empty($_POST['email']) ||!isset($_POST['password']) || empty($_POST['password'])) {
	header('location: connexion.php?message=Veuillez remplir les 2 champs.');
	exit;
}


$log = fopen('log.txt', 'a+');


$line = date("d/m/Y H:i:s") . '- Tentative de connexion de : ' . $_POST['email'] . "\n";

fputs($log, $line);

fclose($log);

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	header('location: connexion.php?message=Email invalide.');
	exit;
}

include('includes/config.php');
$q = 'SELECT id FROM user Where email = :email AND password = :password';
$req = $db->prepare($q);
$req ->execute([
	'email' => $_POST['email'],
	'password' => hash('sha512', $_POST['password'])
]);


$resultat = $req ->fetch(PDO::FETCH_ASSOC);

 if ($resultat) {
 	session_start();
	$_SESSION['email'] = $_POST['email'];
	header('location: index.php');
	exit;

 }else{
	header('location: connexion.php?message=identifiant ou mdp incorrects');
	exit;
}
