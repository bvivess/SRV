<?php
	try {
		$file = fopen("example.txt", "r");
		while(! feof($file)) {
		  $line = fgets($file);
		  echo $line. "<br>";
		}
		fclose($file);
	}
	catch(Exception $e) {
		echo "Defined Exception: " . $e-> getMessage();
	}
?>
