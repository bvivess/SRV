<?php
	use models\Employee;

	require_once dirname(__DIR__, 3) . '/src/config/config.php';
	require_once BASE_PATH . '/vendor/autoload.php';

	function carregaEmpleat($employee_id): ?Employee {
		try {
			return Employee::find($employee_id);
		} catch (Error | Exception $e) {
			echo '<p class="alert alert-danger">Error al carregar l\'empleat: '
				. $e->getMessage() . '</p>';
			return null;
		}
	}

	function modificarEmpleat($employee): void {
		if ($_SERVER['REQUEST_METHOD'] !== 'POST' || $employee === null) {
			return;
		}

		try {
			$employee->first_name = $_POST['first_name'] ?? '';
			$employee->last_name = $_POST['last_name'] ?? '';
			$employee->email = convertToNull($_POST['email'] ?? '');
			$employee->phone_number = convertToNull($_POST['phone_number'] ?? '');
			$employee->hire_date = convertToNull($_POST['hire_date'] ?? '');
			$employee->job_id = $_POST['job_id'] ?? '';
			$employee->salary = convertToNull($_POST['salary'] ?? '');
			$employee->commission_pct = convertToNull($_POST['commission_pct'] ?? '');
			$employee->manager_id = convertToNull($_POST['manager_id'] ?? '');
			$employee->department_id = convertToNull($_POST['department_id'] ?? '');

			$employee->save();

			echo '<p class="alert alert-success">Empleat modificat correctament.</p>';
		} catch (Error | Exception $e) {
			echo '<p class="alert alert-danger">Error en modificar l\'empleat: '
				. htmlspecialchars($e->getMessage()) . '</p>';
		}
	}

	function convertToNull($value) {
		return $value === '' ? null : $value;
	}

	function gestorErrors($errno, $errstr, $errfile, $errline) {
		throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
	}

	set_error_handler('gestorErrors');

	$employee = carregaEmpleat((int) ($_GET['employee_id'] ?? $_POST['employee_id'] ?? 0));

	// Processar el formulari abans de generar l'HTML
	modificarEmpleat($employee);
?>

<!DOCTYPE html>
<html lang="ca">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Modificar empleat</title>
		<link rel="stylesheet" href="<?= BASE_URL ?>/src/css/estils.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	</head>
	<body>
		<?php require_once BASE_PATH . '/src/html/includes/header.php'; ?>

		<div id="content">
			<?php require_once BASE_PATH . '/src/html/includes/nav.php'; ?>

			<main id="section">
				<h3>Modificar empleat</h3>

				<?php if ($employee !== null): ?>
					<form method="POST" action="">
						<div class="form-group">
							<label for="employee_id">ID empleat:</label>
							<input class="form-control" type="number" id="employee_id"
								name="employee_id"
								value="<?= $employee->employee_id ?>"
								readonly required>
						</div>

						<div class="form-group">
							<label for="first_name">Nom:</label>
							<input class="form-control" type="text" id="first_name"
								name="first_name"
								value="<?= $employee->first_name ?>"
								required>
						</div>

						<div class="form-group">
							<label for="last_name">Llinatge:</label>
							<input class="form-control" type="text" id="last_name"
								name="last_name"
								value="<?= $employee->last_name ?>"
								required>
						</div>

						<div class="form-group">
							<label for="email">Email:</label>
							<input class="form-control" type="email" id="email"
								name="email"
								value="<?= $employee->email ?>"
								required>
						</div>

						<div class="form-group">
							<label for="phone_number">Número de telèfon:</label>
							<input class="form-control" type="text" id="phone_number"
								name="phone_number"
								value="<?= $employee->phone_number ?>">
						</div>

						<div class="form-group">
							<label for="hire_date">Data de contractació:</label>
							<input class="form-control" type="date" id="hire_date"
								name="hire_date"
								value="<?= $employee->hire_date ?>"
								required>
						</div>

						<div class="form-group">
							<label for="job_id">ID de treball:</label>
							<input class="form-control" type="text" id="job_id"
								name="job_id"
								value="<?= $employee->job_id ?>"
								required>
						</div>

						<div class="form-group">
							<label for="salary">Salari:</label>
							<input class="form-control" type="number" id="salary"
								name="salary"
								value="<?= $employee->salary ?>"
								step="0.01" required>
						</div>

						<div class="form-group">
							<label for="commission_pct">Comissió:</label>
							<input class="form-control" type="number" id="commission_pct"
								name="commission_pct"
								value="<?= $employee->commission_pct ?>"
								step="0.01">
						</div>

						<div class="form-group">
							<label for="manager_id">ID del gerent:</label>
							<input class="form-control" type="number" id="manager_id"
								name="manager_id"
								value="<?= $employee->manager_id ?>">
						</div>

						<div class="form-group">
							<label for="department_id">ID del departament:</label>
							<input class="form-control" type="number" id="department_id"
								name="department_id"
								value="<?= $employee->department_id ?>">
						</div>

						<button class="btn btn-primary" type="submit">Modificar empleat</button>
						<a href="<?= BASE_URL ?>/src/html/Employees/Employees_list.php"
						class="btn btn-secondary">Tornar</a>
					</form>
				<?php else: ?>
					<p class="alert alert-danger">No s'ha trobat l'empleat.</p>
				<?php endif; ?>
			</main>
		</div>

		<?php require_once BASE_PATH . '/src/html/includes/footer.php'; ?>
	</body>
</html>