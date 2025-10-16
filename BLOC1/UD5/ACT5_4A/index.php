<?php
	/*spl_autoload_register(function($classe) {
		if (file_exists(str_replace('\\','/',$classe) . '.php'))
			require_once(str_replace('\\','/',$classe) . '.php');
	});*/
	
	require 'vendor/autoload.php';

	function convertToNull($value) {
		return $value === '' ? null : $value;
	}

	// Definim el gestor d’errors personalitzat
	function gestorErrors($errno, $errstr, $errfile, $errline) {
		// Convertim l’error en una excepció
		throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
	}

	// Registrem el gestor d’errors
	set_error_handler("gestorErrors");

	use Config\Database;
	use Models\Employee;

    try {
		// Si el formulari ha estat enviat
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			// Obtenir els valors del formulari
			$employee_id    = $_POST['employee_id'];
			$first_name     = $_POST['first_name'];
			$last_name      = $_POST['last_name'];
			$email          = $_POST['email'];
			$phone_number   = $_POST['phone_number'];
			$hire_date      = $_POST['hire_date'];
			$job_id         = $_POST['job_id'];
			$salary         = $_POST['salary'];
			$commission_pct = $_POST['commission_pct'];
			$manager_id     = $_POST['manager_id'];
			$department_id  = $_POST['department_id'];
			
			// Crear una nova instància d'Employee amb els valors del formulari
			$employee = new Employee( $employee_id, 
									$first_name,
									$last_name,
									convertToNull($email),
									convertToNull($phone_number),
									convertToNull($hire_date),
									$job_id, 
									convertToNull($salary), 
									convertToNull($commission_pct), 
									convertToNull($manager_id),
									convertToNull($department_id) );

			// Guardar l'empleat a la base de dades
			$employee->save();  // INSERT / UPDATE
		}
	} catch (Error | Exception $e) {
		// 🔹 Missatge amigable a l'usuari
		echo "<strong>S'ha produït un error.</strong>";

		// 🔹 Registre detallat a fitxer de log
		$logMessage = "[" . date('Y-m-d H:i:s') . "] "
			. $e->getMessage() 
			. " arxiu: " . $e->getFile() 
			. " línia: " . $e->getLine() . PHP_EOL;
		error_log($logMessage, 3, __DIR__ . '/error_log.txt');
	}
?>

<!DOCTYPE html>
<html lang="ca">
	<head>
		<meta charset="UTF-8">
		<title>Formulari d'Empleat</title>
	</head>
	<body>
		<h1>Afegir un Nou Empleat</h1>
		<form method="POST" action="">
			<label>ID Empleat:</label><br>
			<input type="number" name="employee_id" required><br><br>
			
			<label>Nom:</label><br>
			<input type="text" name="first_name" required><br><br>
			
			<label>Llinatge:</label><br>
			<input type="text" name="last_name" required><br><br>
			
			<label>Email:</label><br>
			<input type="email" name="email" required><br><br>
			
			<label>Número de Telèfon:</label><br>
			<input type="text" name="phone_number"><br><br>
			
			<label>Data de Contractació:</label><br>
			<input type="date" name="hire_date" required><br><br>
			
			<label>ID de Treball:</label><br>
			<input type="text" name="job_id" required><br><br>
			
			<label>Salari:</label><br>
			<input type="number" name="salary" step="0.01" required><br><br>
			
			<label>Comissió:</label><br>
			<input type="number" name="commission_pct" step="0.01"><br><br>
			
			<label>ID del Gerent:</label><br>
			<input type="number" name="manager_id"><br><br>
			
			<label>ID del Departament:</label><br>
			<input type="number" name="department_id"><br><br>
			
			<input type="submit" value="Afegir Empleat">
		</form>
	</body>
</html>
