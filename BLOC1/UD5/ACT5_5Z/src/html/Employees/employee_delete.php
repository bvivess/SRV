<?php
	use models\Employee;

	require_once dirname(__DIR__, 3) . '/src/config/config.php';
	require_once BASE_PATH . '/vendor/autoload.php';

	$errorMessage = null;
	$success = false;

	if ($_SERVER['REQUEST_METHOD'] === 'GET') {
		try {
			$employee = new Employee($_GET['employee_id']);
			$employee->destroy();
			$success = true;
		} catch (\Exception $exception) {
			$errorMessage = "L'empleat no es pot eliminar: " . $exception->getMessage();
			$success = false;
		}
	}
?>
<!DOCTYPE html>
<html lang="ca">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Delete Employee</title>
		<link rel="stylesheet" href="<?= BASE_URL ?>/src/css/estils.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	</head>
	<body>
		<?php require_once BASE_PATH . '/src/html/includes/header.php'; ?>
		<div id="content">
			<?php require_once BASE_PATH . '/src/html/includes/nav.php'; ?>
			<main id="section">
				<h3>Delete Employee</h3>

				<?php if ($success): ?>
					<p class="alert alert-success">Empleat eliminat correctament.</p>
				<?php elseif ($errorMessage !== null): ?>
					<p class="alert alert-danger"><?= $errorMessage ?></p>
				<?php endif; ?>

				<a href="<?= BASE_URL ?>/src/html/Employees/Employees_list.php" class="btn btn-secondary">Tornar</a>
			</main>
		</div>
		<?php require_once BASE_PATH . '/src/html/includes/footer.php'; ?>
	</body>
</html>
