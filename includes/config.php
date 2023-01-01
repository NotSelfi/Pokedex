<?php

try {
  $db = new PDO('mysql:host=localhost;dbname=pokedex', 'root','root', [PDO::ERRMODE_EXCEPTION]);
} catch (\Exception $e) {
  die('Erreur : ' . $e->getMessage());
}




 ?>
