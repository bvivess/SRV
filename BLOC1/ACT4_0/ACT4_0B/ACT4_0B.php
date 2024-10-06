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
	
	// Connection data
	DEFINE('HOST', '192.168.210.1'); 
	DEFINE('DBNAME','HR');
	DEFINE('USERNAME','HR');
	DEFINE('PASSWD','Educacio123!');
	$conn = null;

	// Set MySQLi to throw exceptions
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	try {
		// Try a connection ...
		echo '<p>Trying to connect to: '.USERNAME.'/'.PASSWD.'@'.DBNAME.' using MySQLi-OO Programing</p>';
		$conn = new mysqli();
		$conn->connect(HOST, USERNAME, PASSWD, DBNAME);
		$conn->set_charset('utf8');
		
		echo '<p>Connection OK</p>';
		
		// Show a result		
		$table = $conn->query('SELECT employee_id, last_name, first_name FROM employees ORDER BY employee_id ASC');
		while (null !== ($row = $table->fetch_array())){ // OR fetch_assoc( ... )
			//echo $row[0]." ".$row[1]." ".$row[2]."<br>";
			echo $row['employee_id']." ".$row['last_name']." ".$row['first_name']."<br>";
		}

	} catch (mysqli_sql_exception $e) {
		echo "</p>" . $e-> getMessage() . "</p>";
	} catch (Exception $e) {
		echo "</p>" . $e-> getMessage() . "</p>";
 	} catch (Error $e) {
		echo "</p>" . $e-> getMessage() . "</p>";
	} finally {
		try {
			echo "Closing Database";
			$conn->close();
		} catch (Exception $e) {
			// Nothing to do
		} catch (Error $e) {
			// Nothing to do
		}
	}
?>
