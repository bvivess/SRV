<!DOCTYPE html>
<html>
	<body>
		<h1>Control Structures</h1>

		<?php
			$var1 = 10;
			$var2 = 0;
			
			try
			{
				if ($var2 == 0) {
					throw new Exception("No es posible dividir por 0");
					// throw new Error("No es posible dividir por 0");
				} else {
					echo "La división entre " . $var1 . " y " . $var2 . " es: " . $var1 / $var2 . "<br>";
				}
			} catch(Exception $e) {
				// Exception catched
				echo "Exception--> " . $e-> getMessage() . "<br>";
			} catch(Error $e) {
				// Error catched
				echo "Error--> " . $e-> getMessage() . "<br>";
			} finally {
				echo "Finally" . "<br>";
			}
		?>
	</body>
</html>

