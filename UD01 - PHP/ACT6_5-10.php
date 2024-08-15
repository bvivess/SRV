<?php
	function demo($HOST, $DBNAME, $USERNAME, $PASSWD) {
		$stmt = null;
		$conn = null;
		$var1 = 'Doe';
		$var2 = 'John';

		echo "Starting demo <br>";	
		// Set MySQLi to throw exceptions
		mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);			
		try {
			// Preparing the statement to be executed
			$conn = mysqli_connect($HOST, $USERNAME, $PASSWD, $DBNAME);
			
			$stmt = 'CREATE TABLE IF NOT EXISTS personas ( 
						id INT AUTO_INCREMENT PRIMARY KEY, 
						last_name VARCHAR(100) NOT NULL, 
						first_name VARCHAR(100) NOT NULL )';
			$table = mysqli_query($conn, $stmt);
			
			$stmt = 'DELETE FROM personas';
			$table = mysqli_query($conn, $stmt);
			
			$stmt = 'INSERT INTO personas( last_name, first_name ) VALUES( \'' . $var1 . '\',\'' . $var2 . '\')';
			echo 'Executing ' . $stmt . '<br>';
			$table = mysqli_query($conn, $stmt);
		
		} catch (Exception $e) {
			echo "</p>" . $e-> getMessage() . "</p>";
		} finally {
			try {
				echo "Closing Database";
				
				mysqli_close($conn);
			} catch (Error $e) {
				// Nothing to do
			}
		}

	}
	
	echo "<br>demo('Conection should work fine') ---------------------------------------------------------------- <br>";
	demo('192.168.210.1', 'HR', 'HR', 'Educacio123!');
	
	echo "<br>demo('Conection should work wrong') ---------------------------------------------------------------- <br>";
	demo('192.168.210.1', 'XX', 'XX', 'Educacio123!');
?>