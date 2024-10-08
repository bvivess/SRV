<!DOCTYPE html>
<html>
	<body>
		<h1>Constants & Variables</h1>
		
		<?php
			$4site = 'not valid';		 // not valid; starts with a number
			$_4site = 'not valid';		 // not valid; starts with an underscore
			$vàr = 'not recommended'; 	 // not recommended; but 'à	' is (Extended) ASCII 228.
			$var = 'Bob';				 // not same as $Var
			$Var = 'Joe';				 // not same as $Var
			
			$arr = array(1, 2, 3, 4, 5); // Array
			
			echo "$var, $Var";
			echo "$arr";
		?>
	</body>
</html>