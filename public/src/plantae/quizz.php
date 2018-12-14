<?php


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
    	$queryNb="select count(*) as nb from QUIZZ";
    	//Get Results
    	$resultsNb = $db->query($queryNb);
    	$dataNb = $queryNb->fetch();
    	$nbLignes = $dataNb['nb'];

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
    	refresh();

		function refresh(){
			$i = rand(0, $nbLignes);
			$quest = $listeQuestion[$i];
			$answerT = $listeRep1[$i];
			$answerF1 = $listeRep2[$i];
			$answerF2 = $listeRep3[$i];
		}

    	}
    	catch(Exception $e){
    		echo $e->getMessage();
    		exit;	
    	}		
		?>
		<form action="reponse.php" method="POST">
			<label for="question"><?php echo $quest ?></label>
			<select name="cbRep">
				<option value="vrai"><?php echo $answerT ?></option>
				<option value="faux1"><?php echo $answerF1 ?></option>
				<option value="faux2"><?php echo $answerF2 ?></option>
			</select>
			<input type="submit" name="confirm">
		</form>
	</main>
</section>
