<?php
	function demo($var) {
		echo "Starting demo <br>";
		
		switch ($var) {
			case 1 :
				echo "var = 1 <br>"; 
				break;
			case ($var < 10) :
				echo "var < 10 <br>";
				break;
			case ($var < 15) :
				echo "var < 10 <br>";
				break;
			default :
				echo "echo "else option <br>";
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