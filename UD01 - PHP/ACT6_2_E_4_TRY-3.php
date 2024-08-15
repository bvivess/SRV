<!DOCTYPE html>
<html>
	<body>
		<h1>Control Structures</h1>

		<?php

			$name = "Nam11e";

			//check if the name contains only letters, and does not contain the word name

			try {
			   try {
				  // $name contains others characters than a-z, A-Z ??
				  if (preg_match("/[^A-Za-z]/", $name)) {
					   // preg_match — Perform a regular expression match
					   throw new Exception("$name contains character other than a-z A-Z");
				   }  
				   if (strpos(strtolower($name), 'name') !== FALSE) {
					  // strtolower : Make a string lowercase
					  throw new Exception("$name contains the word 'name'");
				   }
				   echo "The Name is valid";
				} catch(Exception $e) {
				 throw new Exception("insert name again",0,$e);
				}
			} catch (Exception $e) {
				if ($e->getPrevious()) {
					echo "The Previous Exception is: ".$e->getPrevious()->getMessage()."<br/>";
				}
				echo "The Exception is: ".$e->getMessage()."<br/>";
			}

		?>
	</body>
</html>