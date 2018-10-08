<?php
	function isIdCreated($bdd,$id)
	{
		// Création du tableau et de la requete selectionnant les id de la base
		$pseudos = array();
		$req = $bdd->query('SELECT id FROM users');
		
		// Pour chaque ligne de la base, on la met dans le tableau et on verifie si egal à ce qu'a mis l'utilisateur 
		foreach ($req as $row) 
		{
			array_push($pseudos, $row['id']);	
			if ($array[] == $id)
			{
				return true;
				break;
			}
		}
	}

	function isMailCreated($bdd,$mail)
	{
		// Création du tableau et de la requete selectionnant les mails de la base
		$mails = array();
		$req = $bdd->query('SELECT mail FROM users');
		
		// Pour chaque ligne de la base, on la met dans le tableau et on verifie si egal à ce qu'a mis l'utilisateur 
		foreach ($req as $row) 
		{
			array_push($pseudos, $row['mail']);	
			if ($array[] == $mail)
			{
				return true;
				break;
			}
		}
	}

	try 
	{
		$bdd = new PDO();
		if ( isset($_POST['signup-id']) && isset($_POST['signup-mail']) && isset($_POST['signup-pass']))
		{
			$id = htmlentities($_POST['signup-id']);
			$mail = htmlentities($_POST['signup-mail']);
			$password = htmlentities($_POST['signup-pass']);

			

			if ((filter_var($mail, FILTRER_VALIDATE_EMAIL)) && (isIdCreated($bdd,$id)) && (isMailCreated($bdd,$mail))
			{
				$insert = $bdd->prepare("INSERT INTO users (id, mail, password) VALUES (:id, :mail, :password)");
			}
		}
	}
	catch( PDOException $e ) 
	{
    echo 'Erreur : ' . $e->getMessage();
    exit;
	}
?>
<form> 
	<label> Votre pseudo : </label>
	<input type="text" name="signup-id">

	<label> Votre mail : </label>
	<input type="text" name="signup-mail">

	<label> Votre mot de passe : </label>
	<input type="password" name="signup-pass">
</form>