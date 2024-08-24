<?php
	function demo($var) {
		echo " Before try block<br>";
		
		// block try-catch
		try {
			echo "Inside try block<br>";
			
			$var1 = 10 / 0;
			
			if ($var == 0) {
				throw new Exception('Throw executed');
				echo "After throw this statement never will be executed) <br>";
			}
		} catch(TypeError $e) {
			echo $e->getMessage() . '<br>';
			echo "TypeError Caught in catch section<br>";
		} catch(Error $e) {
			echo $e->getMessage() . '<br>';
			echo "Error Caught in catch section<br>";
		} catch(Exception $e) {
			echo $e->getMessage() . '<br>';
			echo "Exception Caught in catch section<br>";				
		}
		echo "After catch this statement will be always executed <br>";
	}
	  
	echo "<br>demo(0) ---------------------------------------------------------------- <br>";
	demo(0);
	
	echo "<br>demo(5) ---------------------------------------------------------------- <br>";
	demo(5);
?>