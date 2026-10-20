<?php
use models\Employee;

require_once dirname(__DIR__, 2) . '/config/config.php';
require_once BASE_PATH . '/vendor/autoload.php';
require_once __DIR__ . '/_employee_helpers.php';

$employee = new Employee();
$errors = [];

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $employee = employeeFromPost(null, $errors);

    if ($errors === []) {
        try {
            $employee->save();
            header('Location: ' . BASE_URL . '/src/html/employees/employees_list.php?status=created');
            exit;
        } catch (Throwable $e) {
            $errors['_general'] = 'Unable to save the employee: ' . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Employee</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/src/css/estils.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php require_once BASE_PATH . '/src/html/includes/header.php'; ?>
<div id="content">
    <?php require_once BASE_PATH . '/src/html/includes/nav.php'; ?>
    <main id="section">
        <h3>New Employee</h3>
        <p>Complete the fields below to create an employee record. Fields marked with * are required.</p>

        <?php if (isset($errors['_general'])): ?>
            <div class="alert alert-danger"><?= employeeEscape($errors['_general']) ?></div>
        <?php endif; ?>

        <form action="" method="post">
            <?php $isNew = true; require __DIR__ . '/_employee_form_fields.php'; ?>
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="<?= BASE_URL ?>/src/html/employees/employees_list.php" class="btn btn-secondary ml-2">Cancel</a>
        </form>
    </main>
</div>
<?php require_once BASE_PATH . '/src/html/includes/footer.php'; ?>
</body>
</html>
