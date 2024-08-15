<?php
	function contarLA($var1, $var2) {
		$contar = 0;
		
		echo $var1 . '<br>'; 
		for ($i=0; $i<=strlen($var1); $i++) {
			if ( substr($var1, $i, 2) == $var2 ) {
				$contar++;
			}
		}

		return $contar;
	}
	
	echo contarLA('abcdelasadksdjfkasknala', 'la');

?>