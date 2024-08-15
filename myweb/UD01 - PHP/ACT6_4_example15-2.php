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
	DEFINE('HOST','192.168.210.1'); // 192.168.210.1
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
		$query = 'SELECT employee_id, last_name, first_name
				  FROM employees
				  WHERE employee_id = 100'; // this statement returns 1 row
		$table = mysqli_query($conn, $query);
		echo 'number of rows = ' . mysqli_num_rows($table);
		$row = mysqli_fetch_array($table);
		
		// Show the type of $row
		echo gettype($row);
		echo '<p> Accessing the row by indexed array: ' . $row[0] . " " . $row[1] . " " . $row[2] . '</p>';
		echo '<p> Accessing the row by associative array:' . $row["employee_id"] . " " . $row["last_name"] . " " . $row["first_name"] . '</p>';
	} catch (mysqli_sql_exception $e) {
		echo  $e-> getMessage();
	} catch (Exception $e) {
		echo $e-> getMessage();
	} catch (Error $e) {
		echo $e-> getMessage();
	} finally {
		try {
			echo "Closing Database";
			
			mysqli_close($conn);
		} catch (Error $e) {
			// Nothing to do
		}
	} 
?>