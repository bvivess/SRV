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
	DEFINE('HOST','192.168.210.1');
	DEFINE('DBNAME','HR');
	DEFINE('USERNAME','HR');
	DEFINE('PASSWD','Educacio123!');
	// File data
	DEFINE('PATHFILE','./');
	DEFINE('FILENAME','ACT6_5-11.txt');
	$conn = null;
	$lnum = 0;

	// Set MySQLi to throw exceptions
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	try {
		// Connexion phase
		echo '<p>Trying to connect to: '.USERNAME.'/'.PASSWD.'@'.DBNAME.' on '.HOST.' using MySQLi-Procedural Programing</p>';
		$conn = mysqli_connect(HOST, USERNAME, PASSWD, DBNAME);
		echo '<p>Connection OK</p>';
		
		mysqli_autocommit($conn, false);
		
		if (file_exists(PATHFILE . FILENAME)) {
			echo "Opening file " . PATHFILE . FILENAME . "<br>";
			$file = fopen(PATHFILE . FILENAME, "r");
			
			// para cada fila del archivo
			while(! feof($file)) { 
				$line = fgets($file);
				$lnum++;
				
				// No se procesan las 2 primeras lineas puesto que contienen las cabeceras
				if ($lnum > 2) {
					echo '>>>>>>>>>>>>>>' . $line . '<br>';
					// PERSONES
					$stmt = "INSERT INTO persones( per_id, per_fname, per_lname )
							 VALUES( '" . SUBSTR($line,0,9)   . "','" .
										  SUBSTR($line,10,12) . "','" .
										  SUBSTR($line,22,12) . "')";
					echo $stmt . '<br>'; 
					$table = mysqli_query($conn, $stmt);
					
					// HOBBIES: van de la posicion 35 hasta el final de línea, 8 posiciones cada uno
					for ($i=35; $i<strlen($line) ; $i=$i+8) { // cada 8 posiciones hay 1 hobby
						$stmt = "SELECT * FROM hobbies WHERE hob_id = '" . SUBSTR($line,$i,3) . "'";
						echo $stmt . '<br>';
						
						$table = mysqli_query($conn, $stmt);
						if (mysqli_affected_rows($conn) == 0) {
							$stmt = "INSERT INTO hobbies( hob_id, hob_description )
									 VALUES('" . SUBSTR($line,$i,3) . "','" .
												 SUBSTR($line,$i,6) . "')";
						}
						echo $stmt . '<br>';
						$table = mysqli_query($conn, $stmt);
						
						// HOBBIES X PERSONES
						$stmt = "INSERT INTO hob_x_per( hxp_per_id, hxp_hob_id )
								 VALUES( '" . SUBSTR($line,0,9)  . "','" .
											  SUBSTR($line,$i,3) . "')";
						echo $stmt . '<br>';
						$table = mysqli_query($conn, $stmt);
					}
				}
				

			}
			
			echo "Closing file " . PATHFILE . FILENAME . "<br>";
			fclose($file);
		} else {
			throw new Exception ( 'File does not exists');
		}
		
		mysqli_commit($conn);
		
	} catch (mysqli_sql_exception $e) {
		if ($conn == true) {
			mysqli_rollback($conn);
		}
		echo  $e-> getMessage();
	} catch (Exception $e) {
		echo $e-> getMessage() .'<br>';
	} catch (Error $e) {
		echo $e-> getMessage() .'<br>';
	} finally { 
		// Closing phase
		try {
			echo "Closing Database" . "<br>";
			mysqli_close($conn);
		} catch (Error $e) {
			// Nothing to do
		}
	}
?>