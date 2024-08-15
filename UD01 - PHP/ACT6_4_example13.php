<?php
	function demo($var) {
		echo "Starting demo <br>";
		
		try {
			echo "try-1<br>";
			//throw new Error('Error-1');
			
			// block try-catch-finally-2
			try {
				echo "try-2<br>";
				throw new Exception('Exception-2');
			} catch(Exception $e) {
				echo $e->getMessage() . '<br>';
				echo "catch-2<br>";
			} finally {
				echo "finally-2<br>";
			}
			
		} catch(Exception $e) {
			echo $e->getMessage() . '<br>';
			echo "catch-11<br>";
		} catch(Error $e) {
			echo $e->getMessage() . '<br>';
			echo "catch-12<br>";
		}  
		finally {
			echo "finally-1<br>";
		}
	}
	
	echo "<br>demo(0) ---------------------------------------------------------------- <br>";
	demo(0);
	
	echo "<br>demo(10) ---------------------------------------------------------------- <br>";
	demo(0);
?>