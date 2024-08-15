<?php
	function demo($numeros) {
		$pares = 0;
		$impares = 0;
		$numero = 0;
		
		echo "Starting demo <br>";

		foreach ($numeros as $numero) {
			print "numero " . $numero . "\n";
			
			if (($numero % 2) == 1) {
				$impares++;
			} else {
				$pares++;
			}
		}
		
		print "<p>Han salido ";
		if ($pares == 1) {
			print "1 número par y ";
		} else {
			print $pares . " números pares y ";
		}
		if ($impares == 1) {
			print "1 número impar";
		} else {
			print $impares . " números impares";
		}
		echo ".</p>";
	}
	
	// 
	echo "demo(1) ---------------------------------------------------------------- <br>";
	demo(array(24, 28, 332, 44, 35));
	
		// 
	echo "demo(2) ---------------------------------------------------------------- <br>";
	demo(array(243, 128, 12, 47, 43));
?>