<?php
use models\Employee;

require_once dirname(__DIR__, 2) . '/config/config.php';
require_once BASE_PATH . '/vendor/autoload.php';
require_once __DIR__ . '/_employee_helpers.php';

$employees = [];
$error = null;
try {
    $employees = Employee::all();
} catch (Throwable $e) {
    $error = $e->getMessage();
}

$statusMessages = [
    'created' => 'Employee created successfully.',
    'updated' => 'Employee updated successfully.',
    'deleted' => 'Employee deleted successfully.'
];
$status = $_GET['status'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employees - Human Resource</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/src/css/estils.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>$(function () { $('[data-toggle="tooltip"]').tooltip(); });</script>
</head>
<body>
<?php require_once BASE_PATH . '/src/html/includes/header.php'; ?>
<div id="content">
    <?php require_once BASE_PATH . '/src/html/includes/nav.php'; ?>
    <main id="section">

        <h3 class="mb-0">Employees</h3>
        <a href="<?= BASE_URL ?>/src/html/employees/employee_new.php" class="btn btn-primary">
            <span class="fa fa-plus" aria-hidden="true"></span> New Employee
        </a>
        <?php if (isset($statusMessages[$status])): ?>
            <div class="alert alert-success" role="status"><?= employeeEscape($statusMessages[$status]) ?></div>
        <?php endif; ?>
        <?php if ($error !== null): ?>
            <div class="alert alert-danger">Unable to load employees: <?= employeeEscape($error) ?></div>
        <?php elseif (count($employees) === 0): ?>
            <div class="alert alert-info"><em>No employees were found.</em></div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Department</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($employees as $employee): ?>
                        <tr>
                            <td><?= employeeEscape($employee->employee_id) ?></td>
                            <td><?= employeeEscape($employee->last_name) ?></td>
                            <td><?= employeeEscape($employee->first_name) ?></td>
                            <td><?= employeeEscape($employee->department_id) ?></td>
                            <td class="text-nowrap">
                                <a href="<?= BASE_URL ?>/src/html/employees/employee_read.php?id=<?= (int) $employee->employee_id ?>"
                                   class="mr-2" title="View employee" aria-label="View employee" data-toggle="tooltip">
                                    <span class="fa fa-eye" aria-hidden="true"></span>
                                </a>
                                <a href="<?= BASE_URL ?>/src/html/employees/employee_update.php?id=<?= (int) $employee->employee_id ?>"
                                   class="mr-2" title="Update employee" aria-label="Update employee" data-toggle="tooltip">
                                    <span class="fa fa-pencil" aria-hidden="true"></span>
                                </a>
                                <a href="<?= BASE_URL ?>/src/html/employees/employee_delete.php?id=<?= (int) $employee->employee_id ?>"
                                   title="Delete employee" aria-label="Delete employee" data-toggle="tooltip">
                                    <span class="fa fa-trash" aria-hidden="true"></span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </main>
</div>
<?php require_once BASE_PATH . '/src/html/includes/footer.php'; ?>
</body>
</html>
