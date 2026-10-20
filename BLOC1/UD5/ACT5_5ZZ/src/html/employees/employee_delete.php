<?php
use models\Employee;

require_once dirname(__DIR__, 2) . '/config/config.php';
require_once BASE_PATH . '/vendor/autoload.php';
require_once __DIR__ . '/_employee_helpers.php';

$id = filter_var($_GET['id'] ?? '', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
$employee = null;
$error = null;

if ($id === false) {
    $error = 'A valid employee ID is required.';
} else {
    try {
        $employee = Employee::find((int) $id);
        if ($employee === null) {
            $error = 'The requested employee was not found.';
        } elseif (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
            $employee->destroy();
            header('Location: ' . BASE_URL . '/src/html/employees/employees_list.php?status=deleted');
            exit;
        }
    } catch (Throwable $e) {
        $error = 'Unable to delete the employee: ' . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
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
        <?php if ($error !== null): ?>
            <div class="alert alert-danger"><?= employeeEscape($error) ?></div>
            <a href="<?= BASE_URL ?>/src/html/employees/employees_list.php" class="btn btn-secondary">Back to employees</a>
        <?php else: ?>
            <div class="alert alert-warning">
                Are you sure you want to delete employee
                <strong><?= employeeEscape($employee->employee_id) ?> — <?= employeeEscape($employee->first_name) ?> <?= employeeEscape($employee->last_name) ?></strong>?
                This action cannot be undone.
            </div>
            <form action="<?= employeeEscape($_SERVER['REQUEST_URI'] ?? '') ?>" method="post">
                <button type="submit" class="btn btn-danger">Delete</button>
                <a href="<?= BASE_URL ?>/src/html/employees/employees_list.php" class="btn btn-secondary ml-2">Cancel</a>
            </form>
        <?php endif; ?>
    </main>
</div>
<?php require_once BASE_PATH . '/src/html/includes/footer.php'; ?>
</body>
</html>
