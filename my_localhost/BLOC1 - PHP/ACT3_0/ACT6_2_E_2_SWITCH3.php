<?php
	$nota = 5;
	
	switch($nota) {
		case ($nota < 5) :
			echo "Suspendido";
			break;

		case ($nota = 5) :
			echo "Aprobado";
			break;
			
		case (($nota >= 6) && ($nota <= 9)) :
			echo "Notable";
			break;

		case ($nota = 10) :
			echo "Excelente nota";
			break;
	}
?>