<!DOCTYPE html>
<html>
	<body>
		<h1>Constants & Variables</h1>
		<h2>Arrays</h2>

			<?php
				$cars = array("Volvo","BMW","Toyota");
				
				var_dump($cars);
				echo "<br>";
				foreach( $cars as $car ) {
					echo $car . "<br>";
				}
			?>
	</body>
</html>