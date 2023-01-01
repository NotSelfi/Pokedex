<!DOCTYPE html>
	<html>
		<head>

			<link rel="stylesheet" type="text/css" href="css/style.css">
			<title>Inscription</title>
			<meta charset="utf-8">
		</head>
		<body>

  			<?php include('includes/header.php');
				include('includes/message.php');
  		?>
			<main>

				<div class="main">

					<h1>Connexion</h1>
					<br>
					<div class="test">

 				<div class="Compte" id="possedeCompte">

							<form action="verif_connexion.php" method="post" enctype="multipart/form-data" >
								<h3>Je possède un compte</h3>
							<div class="remplissageInscription">
										<div class="email1">
											<input name="email" type="email"  placeholder="Enter email">
										</div>
										<div class="password1">
											<input name="password" type="password"placeholder="Password">
										</div>
							</div>
							<div >
										<input class="bouton" type="submit" value="Connexion">
							</div>
							</form>
				</div>

				<div class="Compte" id="creerCompte">
							<form action="verif_inscription.php" method="post" enctype="multipart/form-data" >
			          <h3>Je crée un compte</h3>


									<div class="remplissageInscription">
											<div class="pseudo">
												<input name="pseudo" type="pseudo" placeholder="Pseudo">
											</div>
											<div class="email2">
			  					    	 <input name="email" type="email" placeholder="Enter email">
											</div>
											<div class="password2">
								    		<input name="password" type="password"  placeholder="Password">
											</div>
									</div>
									<div class="pdp">
												<p>image de profil :<input type="file" class="file" name="image" accept="image/png, image/gif, image/jpeg"></p>
									 		</div>
									<div >
								  	<input class="bouton "type="submit" value="Inscription">
									</div>
								</form>


								</div>
				</div>


			</main>
<?php include('includes/footer.php'); ?>
		</body>

	</html>
