<?php

	if (isset($_POST['vrai'])){
		if ('reponse' == $answerT){
			echo "vrai";
			print "vrai";
		}
		else {
			echo "faux la bonne reponse est : " . $answerT;
			print "faux";	
		}
	}
	else {
		echo "Actuellement erreur au niveau du POST pour verifier si valeurs justes ou non";
	}

?>


<!-- Sidebar -->
<section id="sidebar">
	<div class="container-fluid">
		<div class="row">
			<nav class="col-md-2 d-none d-md-block sidebar" id="sidebar">
				<div class="sidebar-sticky">
					<br>
					<ul class="nav flex-column">
						<li class="nav-item">
						    <a class="nav-link" href="#">Bouton 1</a>
						</li>
						<li class="nav-item">
						    <a class="nav-link" href="#">Bouton 2</a>
						</li>
						<li class="nav-item">
						    <a class="nav-link" href="#">Bouton 3</a>
						</li>
						<li class="nav-item">
						    <a class="nav-link" href="#">Bouton 4</a>
						</li>

					</ul>
					<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">Paramètres du jeu</h6>
					<ul class="nav flex-column mb-2">
						<li class="nav-item">
						    <a class="nav-link" href="#">Bouton 1</a>
						</li>
						<li class="nav-item">
						    <a class="nav-link" href="#">Bouton 2</a>
						</li>
						<li class="nav-item">
						    <a class="nav-link" href="#">Bouton 3</a>
						</li>
						<li class="nav-item">
						    <a class="nav-link" href="#">Bouton 4</a>
						</li>

					</ul>
				</div>
			</nav>
		</div>
	</div>
</section>


<!-- Main -->
<section id="main-content">
	<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
		<h2>Bienvenue sur le Quizz Plantae !</h2>
		<!--<p style="color: red;">Cette partie du site est actuellement en cours de développement, merci de votre compréhension.</p> -->
		
		<?php

		require_once('./php/bdd.php');
		try {

		// Query
    	$queryNb="SELECT count(*) AS nb FROM QUIZZ";
    	//Get Results
    	
    	$nbLignes = 0;

    	foreach ($db->query($queryNb) as $row){
    		//print $row['nb'];
    		$nbLignes = $row['nb'];
    	}
    	print "Nombres de questions totals actuelles dans la base : " . $nbLignes;
    	//$dataNb = $queryNb->fetch(PDO::FETCH_ASSOC);
    	//$nbLignes = $resultsNb['nb'];


		$listeQuestion = array();
    	$listeRep1 = array();
    	$listeRep2 = array();
    	$listeRep3 = array();
    	
    	$query = "SELECT * FROM QUIZZ";
    	$results = $db->query($query);


    	foreach ($db->query($query) as $row) {
    		array_push($listeQuestion, $row['question']);
    		array_push($listeRep1, $row['reponseJ']);
    		array_push($listeRep2, $row['reponseF1']);
    		array_push($listeRep3, $row['reponseF2']);
    	}

    	/*
    	$i = 0;
    	while ($resultat = $results->fetch()) 
    	{
      		$listeQuestion = $resultat['question'];
      		$listeRep1 = $resultat['reponseJ'];
      		$listeRep2 = $resultat['reponseF1'];
      		$listeRep3 = $resultat['reponseF2'];
      		$i++;
    	}
		*/
    	$quest = $listeQuestion[0];
    	$answerT = $listeRep1[0];
    	$answerF1 = $listeRep2[0];
    	$answerF2 = $listeRep3[0];
    	$id = 0;


    	function refresh($nbLignes, $listQuest, $listRep1, $listRep2, $listRep3){
			$i = rand(0, $nbLignes - 1);
			$quest = $listQuest[$i];
			$answerT = $listRep1[$i];
			$answerF1 = $listRep2[$i];
			$answerF2 = $listRep3[$i];
			return $i;
		}

    	
    	$id = refresh($nbLignes, $listeQuestion, $listeRep1, $listeRep2, $listeRep3);

    	}
    	catch(Exception $e){
    		echo $e->getMessage();
    		exit;	
    	}		
		?>

		<form action="" method="POST">
			<input type="hidden" name="id" value=<?php echo $id ?> >
			<label for="question"> <?php echo $quest ?> </label> 
			<select name="cbRep">
				<option value="vrai" name="vrai"> <?php echo $answerT ?> </option>
				<option value="faux1" name="faux1"> <?php echo $answerF1 ?> </option>
				<option value="faux2" name="faux2"> <?php echo $answerF2 ?> </option>
			</select>
			<input type="submit" name="confirm">
		</form>
	</main>
</section>
