<?php

if (isset($_POST['reponse'])){
	if ('reponse' == $answerT){
		echo "<script type='text/javascript'>alert('Reponse juste');</script>";
	}
	else {
		echo "<script type='text/javascript'>alert('Reponse fausse, la bonne réponse est $answerT');</script>";
	}
}



?>