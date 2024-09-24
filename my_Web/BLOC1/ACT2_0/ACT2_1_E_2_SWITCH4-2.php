<?php
	$nota = 4.75;
	
	echo $nota . ': ';
	switch($nota) {
		case ($nota < 5):
			echo "Suspendido";
			break;
			
		case ($nota < 6) :
			echo "Aprobado";
			break;
			
		case ($nota < 7) :
			echo "Bien";
			break;
			
		case ($nota < 9) : 
			echo "Notable";
			break;

		default :
			echo "Excelente";
			break;
	}
?>