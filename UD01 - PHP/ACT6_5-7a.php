<?php
	header("Cache-Control: no-cache, must-revalidate");
	
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
	DEFINE('HOST','192.168.210.1');
	DEFINE('DBNAME','HR');
	DEFINE('USERNAME','HR');
	DEFINE('PASSWD','Educacio123!');
	$conn = null;
	
	// Set MySQLi to throw exceptions
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);	
	try {
		// Connexion phase
		echo '<p>Trying to connect to: '.USERNAME.'/'.PASSWD.'@'.DBNAME.' on '.HOST.' using MySQLi-Procedural Programing</p>';
		$conn = mysqli_connect(HOST, USERNAME, PASSWD, DBNAME);
		echo '<p>Connection OK</p>';
		
		//mysqli_autocommit($conn, false);
			
		// Execution phase
		$query = 'SELECT d.department_id department_id, department_name 
		          FROM departments d LEFT JOIN employees e ON d.department_id = e.department_id
				  WHERE e.employee_id IS NULL  
				  ORDER BY department_name ';
		$table = mysqli_query($conn, $query);
		
		if (mysqli_affected_rows($conn) !== 0) {
			echo '<table border="1"><th>Department ID</th><th>Department Name</th>';
			while( null !== ($row = mysqli_fetch_array($table)) ) { 
				echo '<tr>';
				echo '<td>' . $row["department_id"] . '</td>' . '<td>' . $row["department_name"] . '</td>';
				echo '</tr>';
			}
			echo "</table>";
		} else {
			echo '<p>No existe ningún departamento selecccionado' . '</p>';			
		}


		//mysqli_commit($conn);
		
	} catch (mysqli_sql_exception $e) {
		//if ($conn == true) {
		//	mysqli_rollback($conn);
		//}
		echo  $e-> getMessage();
	} catch (Exception $e) {
		echo $e-> getMessage();
	} catch (Error $e) {
		echo $e-> getMessage();
	} finally { 
		// Closing phase
		try {
			echo '<p>Closing Database</p>';

			mysqli_close($conn);
		} catch (Error $e) {
			// Nothing to do
		}
	}
?>