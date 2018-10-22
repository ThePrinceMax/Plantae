<?php
	session_start();

	// Si la requête arrive avec un autre type que GET
	// ou que le client n'est pas considéré comme connecté
	if ( $_SERVER['REQUEST_METHOD'] != 'GET' || !isset($_SESSION['user']) )
	{
        // on envoie une demande de redirection en GET vers signin.php
        header('Location: index.php');
        exit;
	}

	// sinon, on affiche la page de bienvenue
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>My account</title>
		<link rel="stylesheet" href="materialize.min.css">
    </head>
    <body class="container">
		<h1 class="center-align">Bonjour <?= $_SESSION['user']; ?> !</h1>
        <p class="center-align">
			Bienvenue sur votre compte.
		</p>
        <p class="center-align"><a class="btn" href="signout.php">Sign out</a></p>
<a class="btn btn-link mx-auto" href="./change.php" role="button">Vous souhaitez changer votre mot de passe ? Cliquez ici !</a>
    </body>
</html>
