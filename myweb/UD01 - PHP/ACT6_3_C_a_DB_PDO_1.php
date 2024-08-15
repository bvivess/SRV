<?php
	$host='192.168.210.1';
	$dbname='HR';
	$username='HR';
	$passwd='Educacio123!';
	$conn = null;

	try {
		// try to connect
		//echo '<p>Trying to connect to: '.username.'/'.passwd.'@'.dbname.' using PDO-OO Programing</p>';
		$conn = new PDO("mysql:host=$host; dbname=$dbname", $username, $passwd);
		echo '<p>Connection OK</p>';
		
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		echo "Connected successfully  using PDO-OO Programing<br>";

		// use the connection here
		$query = $conn->query('SELECT employee_id, last_name, first_name FROM employees');

		// fetch all rows into array, by default PDO::FETCH_BOTH is used
		$table = $query->fetchAll();

		// iterate over array by index and by name
		foreach($table as $row) {

			// echo "$row[0] $row[1] $row[2]\n");
			echo $row['employee_id'] . " " . $row['last_name']. " " . $row['first_name'] . "<br>";

		}


		$conn = null;
		echo "Closing Database";
	}
	catch(PDOException $e) {
	   echo "Connection failed: " . $e->getMessage();
	}
?>