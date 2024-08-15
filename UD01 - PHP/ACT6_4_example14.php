<?php
	function demo($var) {
		echo "Starting demo <br>";
		
		try {
			echo "try-1<br>";
			if ($var > 0) {
				throw new Exception('Exception-1');
			} else {
				echo "Else option executed <br>";
			}
			
			// block try-catch-finally-2
			try {
				echo "try-2<br>";
				
				if ($var > 0) {
					throw new Exception('Exception-2');
				}
			} catch(Exception $e) {
				echo $e->getMessage() . '<br>';
				echo "catch-2<br>";
			} finally {
				echo "finally-2<br>";
			}
			
		} catch(Error $e) {
			echo $e->getMessage() . '<br>';
			echo "catch-1<br>";
		} finally {
			echo "finally-1<br>";
		}
	}
	
	echo "<br>demo(0) ---------------------------------------------------------------- <br>";
	demo(0);
	
	echo "<br>demo(5) ---------------------------------------------------------------- <br>";
	demo(5);
?>