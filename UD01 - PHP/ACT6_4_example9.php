<?php
	function demo($var) {
		echo " Before try block<br>";
		
		// block try-catch
	try {
		try {
			echo "Inside try block, entering <br>";
			
			$var = 10 / 0;
			
			if ($var == 0) {
				throw new Exception('Throw executed');
				echo "After throw this statement never will be executed) <br>";
			}
			
			echo "Inside try block, exiting <br>";
		} catch(Exception $e) {
			echo $e->getMessage() . '<br>';
			echo "Exception Caught in catch section<br>";
		} finally {
			echo "Inside finally block <br>";
		}
	} catch(Error $e) {
			echo $e->getMessage() . '<br>';
			echo "zxzcxczczxzcxczxzcx Caught in catch section<br>";		
	}
		
		echo " After try block<br>";		
	}
	  
	echo "<br>demo(0) ---------------------------------------------------------------- <br>";
	demo(0);
	
	echo "<br>demo(5) ---------------------------------------------------------------- <br>";
	demo(5);
?>