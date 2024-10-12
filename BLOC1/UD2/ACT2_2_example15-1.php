<?php
	// Define handler
	set_error_handler(function ($err_severity, $err_msg) {
		switch ($err_severity) {
			case E_ERROR:
			case E_USER_ERROR:
			case E_WARNING:
			case E_USER_WARNING:
				throw new Exception('-->' . $err_msg);
			default:
				throw new Error('-->' . $err_msg);
		}
	});

	// Defining error level
	error_reporting(E_ALL);

	// Connection data
	DEFINE('HOST','127.0.0.1'); // 192.168.210.1
	DEFINE('DBNAME','HR');
	DEFINE('USERNAME','HR');
	DEFINE('PASSWD','Educacio123!');
	$conn = null;
	
	// Set MySQLi to throw exceptions
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	try {
		// Try a connection ...
		echo '<p>Trying to connect to: '.USERNAME.'/'.PASSWD.'@'.DBNAME.' using MySQLi-Procedural Programing</p>';
		$conn = mysqli_connect(HOST, USERNAME, PASSWD, DBNAME);
		echo '<p>Connection OK</p>';

		// Show a result		
		$query = 'SELECT employee_id, last_name, first_name FROM employees ORDER BY employee_id ASC';
		$table = mysqli_query($conn, $query);
		
		foreach ($table as $row) {
			foreach($row as $column) {
				echo $column . ' ';
			}
			echo "<br>";
		}
	} catch (mysqli_sql_exception $e) {
		echo  "</p>" . $e-> getMessage() . "</p>";
	} catch (Exception $e) {
		echo "</p>" . $e-> getMessage() . "</p>";
 	} catch (Error $e) {
		echo "</p>" . $e-> getMessage() . "</p>";
	} finally {
		try {
			echo "Closing Database";
			
			mysqli_close($conn);
		} catch (Error $e) {
			// Nothing to do
		}
	}
?>
