<?php
	function demo($n, $m) {
		$i = 0;
		$j = 0;
		
		echo "<h1>Starting demo </h1>";
		
		echo '<table border="1">';
		for ($i=0; $i <= $n; $i++) {
			echo '<tr>';
			for ($j=1; $j <= $m; $j++) {
				if ($i == 0) {
					echo '<th>' . $i . '</th>';
				} else {
					echo '<td>' . $j. '</td>';
				}
			}
			echo "</tr>";
		}
		echo '<table>';
	}
	
	// 
	echo "demo(3,3) ---------------------------------------------------------------- <br>";
	demo(3,3);
	
		// 
	echo "demo(2,4) ---------------------------------------------------------------- <br>";
	demo(2,4);
?>