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
	$dpt_ant = ''; // 'dpt_ant' --> guardamos en una variable el departamento anterior 
	
	// Set MySQLi to throw exceptions
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);	
	try {
		// Connexion phase
		echo '<p>Trying to connect to: '.USERNAME.'/'.PASSWD.'@'.DBNAME.' on '.HOST.' using MySQLi-Procedural Programing</p>';
		$conn = mysqli_connect(HOST, USERNAME, PASSWD, DBNAME);
		echo '<p>Connection OK</p>';
		
		//mysqli_autocommit($conn, false);
			
		// Execution phase
		$query = 'SELECT department_name, e.employee_id employee_id, last_name, first_name 
		          FROM departments d, employees e 
				  WHERE d.department_id = e.department_id
				  ORDER BY department_name, last_name, first_name';
		$table = mysqli_query($conn, $query);
		
		echo '<table border="0"><th>Department Name</th><th>Employee ID</th><th>Last Name</th><th>First Name</th>';
		// 'dpt_ant' = ''
		while( null !== ($row = mysqli_fetch_array($table)) ) { 
			// comparamos el 'dpt_ant' con el actual, si es diferente mostramos el 'department_name'
			// si es igual, no lo mostramos
			switch ($dpt_ant !== $row["department_name"]) {
				case true : 
					echo '<tr>';
					echo '<td>' . $row["department_name"] . '</td>';
					echo '</tr>';
				case false :
					echo '<tr>';
					echo '<td></td><td>'.$row["employee_id"] . '</td><td>' . $row["last_name"] . '</td><td>' . $row["first_name"] . '</td>';
					echo '</tr>';
			}
			
			// actualizamos 'dpt_ant'
			$dpt_ant = $row["department_name"];
		}
		echo "</table>";

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
			echo "Closing Database";

			mysqli_close($conn);
		} catch (Error $e) {
			// Nothing to do
		}
	}
?>