<?php
	function db_connect( $host, $dbname, $username, $passwd ){	
		// Try a connection ...
		echo '<p>Trying to connect to: '.$username.'/'.$passwd.'@'.$dbname.'</p>';
		$conn = mysqli_connect($host, $username, $passwd, $dbname);
		if ($conn == true) {
			return $conn;
		} else {
			return null;
		}
	}
?>