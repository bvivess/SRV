<!DOCTYPE html>
<html>
	<body>
		<h1>Control Structures</h1>

		<?php
			$beer = 'san miguel';

			if (($beer == 'carlsberg') OR ($beer == 'heineken')) {
					echo 'Good choice';
			} else {
					echo 'Please make a new selection...';
			}
		?>
	</body>
</html>