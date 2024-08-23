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
	$lname = 'xxxx';
	$fname = 'yyyy';
	
	// Set MySQLi to throw exceptions
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);	
	try {
		// Try a connection ...
		echo '<p>Trying to connect to: '.USERNAME.'/'.PASSWD.'@'.DBNAME.' using MySQLi-Procedural Programing</p>';
		$conn = mysqli_connect(HOST, USERNAME, PASSWD, DBNAME);
		echo '<p>Connection OK</p>';
		
		mysqli_autocommit($conn, false);
		
		$stmt = 'CREATE TABLE IF NOT EXISTS temporal ( 
					id INT AUTO_INCREMENT PRIMARY KEY, 
					last_name VARCHAR(100) NOT NULL, 
					first_name VARCHAR(100) NOT NULL )
					ENGINE = MyISAM'; // InnoDB suports COMMIT/ROLLBACK transactions, MyISAM does not 
		$table = mysqli_query($conn, $stmt);

		// $stmt = 'DELETE FROM temporal';
		// $table = mysqli_query($conn, $stmt);

		// Preparing the statement to be executed			
		$stmt = 'INSERT INTO temporal( last_name, first_name ) VALUES( ?, ? )';
		$query = mysqli_prepare($conn, $stmt);
		mysqli_stmt_bind_param($query, "ss", $lname, $fname);
		
		// Executing the prepared statement
		mysqli_stmt_execute($query);
		$table = mysqli_stmt_get_result($query);
		
		mysqli_commit($conn);
		
	} catch (mysqli_sql_exception $e) {
		if ($conn == true) {
			mysqli_rollback($conn);
		}
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