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
	DEFINE('HOST', 'localhost'); 
	DEFINE('DBNAME','HR');
	DEFINE('USERNAME','root');
	DEFINE('PASSWD','');
	$conn = null;

	// Set MySQLi to throw exceptions
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	try {
		// Try a connection ...
		echo '<p>Trying to connect to: '.USERNAME.'/'.PASSWD.'@'.DBNAME.' using MySQLi-OO Programing</p>';
		$conn = new mysqli(HOST, USERNAME, PASSWD, DBNAME);
		$conn->set_charset('utf8');
		
		echo '<p>Connection OK</p>';
		$conn->autocommit(false);
        $conn->begin_transaction();  // if necessary
		// Show a result		
		$table = $conn->query('SELECT employee_id, last_name, first_name FROM employees ORDER BY employee_id ASC');
		while (null !== ($row = $table->fetch_assoc())){ // OR fetch_array()
			//echo $row[0]." ".$row[1]." ".$row[2]."<br>";
			echo $row['employee_id']." ".$row['last_name']." ".$row['first_name']."<br>";
		}
		$conn->commit();  // if necessary
	} catch (mysqli_sql_exception $e) {
        if ($conn)
            $conn->rollback();  // if necessary
        echo "Error connecting to MySQL: " . $e->getMessage();
	} finally {
        if ($conn)
            $conn->close(); // DISCONNECTION PHASE
	}
?>
