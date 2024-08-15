<?php
	function demo($var) {
		echo "Starting demo <br>";
		
		// block try-catch-finally
		try {
			echo "Inside try block<br>";
			
			if ($var == 0) {
				throw new mysqli_sql_exception('Throw executed');
				echo "After throw, this statement never will be executed <br>";
			} else {
				echo "This statement may be executed <br>";
				$var = 0;
			}
		} catch(Error $e) {
			echo $e->getMessage() . '<br>';
			echo "Exception Caught in catch section <br>";
		} catch(Exception $e) {
			echo $e->getMessage() . '<br>';
			echo "Exception Caught in catch section <br>";
		} finally {
			echo "this statement always will be executed in finally section <br>";
		}
	}
	
	// Inicio 
	echo "demo(5) ---------------------------------------------------------------- <br>";
	demo(5);
	
	echo "demo(0) ---------------------------------------------------------------- <br>";
	demo(0);
?>