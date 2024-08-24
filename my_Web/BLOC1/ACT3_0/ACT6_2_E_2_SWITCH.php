<!DOCTYPE html>
<html>
	<body>
		<h1>Control Structures</h1>

		<?php
			$beer = 'san miguel';

			switch($beer) {
				case 'carlsberg':
				case 'heineken':
					echo 'Good choice';
					break;
				default;
					echo 'Please make a new selection...';
					break;
			}
		?>


	</body>
</html>