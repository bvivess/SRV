<?php
	function demo($numeros, $var1) {
		$mayores = 0;
		$menores = 0;
		$iguales = 0;
		$numero  = 0;
		
		echo "Starting demo <br>";

		foreach ($numeros as $numero) {
			print "numero " . $numero . "\n";
			
			if ($numero == $var1) {
				$iguales++;
			} elseif ($numero < $var1){
				$menores++;
			} else {
				$mayores++;
			}
		}
		
		print "<p>Han salido ";
		if ($iguales == 1) {
			print "1 número igual y ";
		} else {
			print $iguales . " números iguales y ";
		}
		if ($menores == 1) {
			print "1 número menor y ";
		} else {
			print $menores . " números menores y ";
		}
		if ($mayores == 1) {
			print "1 número mayor.";
		} else {
			print $mayores . " números mayores.";
		}
		echo ".</p>";
	}
	
	// 
	echo "demo(1) ---------------------------------------------------------------- <br>";
	demo(array(24, 28, 332, 44, 35),35);
	
		// 
	echo "demo(2) ---------------------------------------------------------------- <br>";
	demo(array(243, 128, 12, 47, 43),43);
?>