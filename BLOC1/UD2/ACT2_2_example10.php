<?php
	function demo($var1, $var2) {
		echo " Before try block<br>";
		
		// block try-catch
		try {
			echo "Inside try block, entering <br>";
			
			if ($var1 != 5) {
				// for1
				for ($i = $var1; $i <= $var2; $i++) {
					echo "Inside for1 block, step " . $i . " <br>";
					
					// for2
					for ($j = $var2; $j <= $var1; $j--) {
						echo "Inside for2 block, step " . $j . " <br>";
					}
				}
			} else {
				throw new Exception('Throw executed');
			}
			
			echo "Inside try block, exiting <br>";
		} catch(Exception $e) {
			echo $e->getMessage() . '<br>';
			echo "Exception Caught in catch section<br>";
		} finally {
			echo "Inside finally block <br>";
		}
		
		echo " After try block<br>";
	}
	  
	echo "<br>demo(3,5) ---------------------------------------------------------------- <br>";
	demo(3,5);
	
	echo "<br>demo(5,3) ---------------------------------------------------------------- <br>";
	demo(5,3);
	
	echo "<br>demo(3,10) ---------------------------------------------------------------- <br>";
	demo(3,10);
	
	echo "<br>demo(10,3) ---------------------------------------------------------------- <br>";
	demo(10,3);
?>