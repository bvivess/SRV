<?php
	class myException extends Exception {}
	
	function demo($n, $m) {
		$i = $n;
		$j = $m;
		
		echo "Starting demo <br>";

		try {
			echo "Inside try block<br>";
			if ($i > $j) {
				throw new myException("$i is greater than $j");
			} elseif ($i <= $j) {
				while ($i <= $n) {
					echo $i . "--> ";
					while ($j <= $m) {
						echo $j. " ";
						if ($i = $j) {
							throw new myException("$i and $j are equal");
						} else {
							$j--;
						}
					}
					$i++;
					echo "<br>";
				}
			} else {
				throw new myException("$i is shorter than $j");
			}
			echo "After try block <br>";
		} catch (myException $e) {
			echo "Exception--> " . $e-> getMessage() . '<br>';
		}
	}
	
	// 
	echo "demo(1,10) ---------------------------------------------------------------- <br>";
	demo(1,10);
	
	echo "demo(10,1) ---------------------------------------------------------------- <br>";
	demo(10,1);
	
	echo "demo(5,5) ---------------------------------------------------------------- <br>";
	demo(5,5);
?>