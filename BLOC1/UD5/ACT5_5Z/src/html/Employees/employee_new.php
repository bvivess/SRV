<?php
	use models\Employee;

	require_once dirname(__DIR__, 3) . '/src/config/config.php';
	require_once BASE_PATH . '/vendor/autoload.php';

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

	$errorMessage = null;
	$status = null;

    try {
		// Si el formulari ha estat enviat
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			// Crear una nova instància d'Employee amb els valors del formulari
			$employee = new Employee( $_POST['employee_id'], 
									  $_POST['first_name'],
								  	  $_POST['last_name'],
									  convertToNull($_POST['email']),
									  convertToNull($_POST['phone_number']),
									  convertToNull($_POST['hire_date']),
									  $_POST['job_id'], 
									  convertToNull($_POST['salary']), 
									  convertToNull($_POST['commission_pct']), 
									  convertToNull($_POST['manager_id']),
									  convertToNull($_POST['department_id']) );

			// Guardar l'empleat a la base de dades
			$employee->save();  // INSERT / UPDATE
			$status = true;  // Indicar que l'operació ha estat exitosa
		}
	} catch (Error | Exception $e) {
		// Missatge amigable a l'usuari
		$errorMessage = "L'empleat no es pot afegir: " . $e->getMessage();
		$status = false;  // Indicar que hi ha hagut un error
	}
?>

<!DOCTYPE html>
<html lang="ca">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Formulari d'Empleat</title>
		<link rel="stylesheet" href="<?= BASE_URL ?>/src/css/estils.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	</head>
	<body>
		<?php require_once BASE_PATH . '/src/html/includes/header.php'; ?>
		<div id="content">
			<?php require_once BASE_PATH . '/src/html/includes/nav.php'; ?>
			<main id="section">
				<h3>Afegir un Nou Empleat</h3>
				
				<form method="POST" action="">
					<div class="form-group">
						<label for="employee_id">ID Empleat:</label>
						<input class="form-control" type="number" id="employee_id" name="employee_id" required>
					</div>
					<div class="form-group">
						<label for="first_name">Nom:</label>
						<input class="form-control" type="text" id="first_name" name="first_name" required>
					</div>
					<div class="form-group">
						<label for="last_name">Llinatge:</label>
						<input class="form-control" type="text" id="last_name" name="last_name" required>
					</div>
					<div class="form-group">
						<label for="email">Email:</label>
						<input class="form-control" type="email" id="email" name="email" required>
					</div>
					<div class="form-group">
						<label for="phone_number">Número de Telèfon:</label>
						<input class="form-control" type="text" id="phone_number" name="phone_number">
					</div>
					<div class="form-group">
						<label for="hire_date">Data de Contractació:</label>
						<input class="form-control" type="date" id="hire_date" name="hire_date" required>
					</div>
					<div class="form-group">
						<label for="job_id">ID de Treball:</label>
						<input class="form-control" type="text" id="job_id" name="job_id" required>
					</div>
					<div class="form-group">
						<label for="salary">Salari:</label>
						<input class="form-control" type="number" id="salary" name="salary" step="0.01" required>
					</div>
					<div class="form-group">
						<label for="commission_pct">Comissió:</label>
						<input class="form-control" type="number" id="commission_pct" name="commission_pct" step="0.01">
					</div>
					<div class="form-group">
						<label for="manager_id">ID del Gerent:</label>
						<input class="form-control" type="number" id="manager_id" name="manager_id">
					</div>
					<div class="form-group">
						<label for="department_id">ID del Departament:</label>
						<input class="form-control" type="number" id="department_id" name="department_id">
					</div>
					<button class="btn btn-primary" type="submit">Afegir Empleat</button>
					
					<a href="<?= BASE_URL ?>/src/html/Employees/Employees_list.php" class="btn btn-secondary">Tornar</a>
				</form>

				<?php if ($status): ?>
					<p class="alert alert-success">Empleat afegit correctament.</p>
				<?php elseif ($errorMessage != null): ?>
					<p class="alert alert-danger"><?= $errorMessage ?></p>
				<?php endif; ?>
			</main>

			</main>
		</div>
		<?php require_once BASE_PATH . '/src/html/includes/footer.php'; ?>
	</body>
</html>
