<?php
use models\Employee;

require_once dirname(__DIR__, 2) . '/config/config.php';
require_once BASE_PATH . '/vendor/autoload.php';
require_once __DIR__ . '/_employee_helpers.php';

$id = filter_var($_GET['id'] ?? '', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
$employee = null;
$errors = [];

if ($id === false) {
    $errors['_general'] = 'A valid employee ID is required.';
} else {
    try {
        $employee = Employee::find((int) $id);
        if ($employee === null) {
            $errors['_general'] = 'The requested employee was not found.';
        }
    } catch (Throwable $e) {
        $errors['_general'] = 'Unable to load the employee: ' . $e->getMessage();
    }
}

if ($employee !== null && ($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $employee = employeeFromPost((int) $id, $errors);

    if ($errors === []) {
        try {
            $employee->save();
            header('Location: ' . BASE_URL . '/src/html/employees/employees_list.php?status=updated');
            exit;
        } catch (Throwable $e) {
            $errors['_general'] = 'Unable to update the employee: ' . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Employee</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/src/css/estils.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php require_once BASE_PATH . '/src/html/includes/header.php'; ?>
<div id="content">
    <?php require_once BASE_PATH . '/src/html/includes/nav.php'; ?>
    <main id="section">
        <h3>Update Employee</h3>
        <p>Edit the employee fields and submit the form to save the changes.</p>

        <?php if (isset($errors['_general'])): ?>
            <div class="alert alert-danger"><?= employeeEscape($errors['_general']) ?></div>
        <?php endif; ?>

        <?php if ($employee !== null): ?>
            <form action="<?= employeeEscape($_SERVER['REQUEST_URI'] ?? '') ?>" method="post">
                <?php $isNew = false; require __DIR__ . '/_employee_form_fields.php'; ?>
                <button type="submit" class="btn btn-primary">Save changes</button>
                <a href="<?= BASE_URL ?>/src/html/employees/employees_list.php" class="btn btn-secondary ml-2">Cancel</a>
            </form>
        <?php else: ?>
            <a href="<?= BASE_URL ?>/src/html/employees/employees_list.php" class="btn btn-secondary">Back to employees</a>
        <?php endif; ?>
    </main>
</div>
<?php require_once BASE_PATH . '/src/html/includes/footer.php'; ?>
</body>
</html>
