<?php
	$nota = 3;
	
	echo $nota . ': ';
	switch($nota) {
		case (5) :
			echo "Aprobado";
			break;
			
		case (6) :
			echo "Bien";
			break;
			
		case (7) : 
		case (8) : 
			echo "Notable";
			break;

		case (9) :
		case (10) :
			echo "Excelente";
			break;
			
		default :
			echo "Suspendido";
			break;
	}
?>