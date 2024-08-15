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
	$dpt_ID = 1000;
	
	// Set MySQLi to throw exceptions
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);	
	try {
		// Connexion phase
		echo '<p>Trying to connect to: '.USERNAME.'/'.PASSWD.'@'.DBNAME.' on '.HOST.' using MySQLi-Procedural Programing</p>';
		$conn = mysqli_connect(HOST, USERNAME, PASSWD, DBNAME);
		echo '<p>Connection OK</p>';
		
		mysqli_autocommit($conn, false);
			
		// Execution phase
		// Se comprueba si existe alguna dependencia funcional de la fila a eliminar
		$query = " SELECT 1
				   FROM employees
				   WHERE department_id = '$dpt_ID'" .
				 " UNION
				   SELECT 1
				   FROM job_history
				   WHERE department_id = '$dpt_ID'";
		echo $query . '<br>';
		$result = mysqli_query($conn, $query);
		
		if (mysqli_affected_rows($conn) !== 0) {
			// Si existe, se muestra un mensaje
			echo 'No es posible eliminar el Department con ID=' . $dpt_ID . '<br>';
		} else {
			// Si no existe, se elimina la fila
			$query = "DELETE FROM departments
					  WHERE department_id = '$dpt_ID'";
			echo $query . '<br>';
		
			$result = mysqli_query($conn, $query);
			echo 'Se ha/n eliminado ' . mysqli_affected_rows($conn) . ' fila/s' . '<br>';
			
			mysqli_commit($conn);
		}
		
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
		// Closing phase
		try {
			echo "Closing Database";

			mysqli_close($conn);
		} catch (Error $e) {
			// Nothing to do
		}
	}
?>