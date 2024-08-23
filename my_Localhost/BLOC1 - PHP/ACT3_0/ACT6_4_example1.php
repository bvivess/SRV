<?php
	function demo($var) {
		echo "Starting demo <br>";
		
		if ($var == '1') {
			echo "var = 1 <br>";
		} elseif ($var < 10) {
			echo "var < 10 <br>";
		} elseif ($var < 15) {
			echo "var < 10 <br>";
		} else {
			echo "else option <br>";
		}
	}
	// 
	echo "demo(1) ---------------------------------------------------------------- <br>";
	demo(1);

	// 
	echo "demo(8) ---------------------------------------------------------------- <br>";
	demo(8);
	
	//
	echo "demo(12) ---------------------------------------------------------------- <br>";
	demo(15);
?>