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
        }
    } catch (Throwable $e) {
        $error = 'Unable to load the employee: ' . $e->getMessage();
    }
}

$fields = $employee === null ? [] : [
    'Employee ID' => $employee->employee_id,
    'First Name' => $employee->first_name,
    'Last Name' => $employee->last_name,
    'Email' => $employee->email,
    'Phone Number' => $employee->phone_number,
    'Hire Date' => $employee->hire_date === null ? null : substr((string) $employee->hire_date, 0, 10),
    'Job ID' => $employee->job_id,
    'Salary' => $employee->salary,
    'Commission' => $employee->commission_pct,
    'Manager ID' => $employee->manager_id,
    'Department ID' => $employee->department_id
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employee Details</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/src/css/estils.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php require_once BASE_PATH . '/src/html/includes/header.php'; ?>
<div id="content">
    <?php require_once BASE_PATH . '/src/html/includes/nav.php'; ?>
    <main id="section">
        <h3>Employee Details</h3>
        <?php if ($error !== null): ?>
            <div class="alert alert-danger"><?= employeeEscape($error) ?></div>
        <?php else: ?>
            <table class="table table-bordered table-striped">
                <tbody>
                <?php foreach ($fields as $label => $value): ?>
                    <tr>
                        <th scope="row"><?= employeeEscape($label) ?></th>
                        <td><?= employeeEscape($value === null ? '—' : $value) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <a href="<?= BASE_URL ?>/src/html/employees/employee_update.php?id=<?= (int) $employee->employee_id ?>" class="btn btn-primary">Edit</a>
        <?php endif; ?>
        <a href="<?= BASE_URL ?>/src/html/employees/employees_list.php" class="btn btn-secondary ml-2">Back to employees</a>
    </main>
</div>
<?php require_once BASE_PATH . '/src/html/includes/footer.php'; ?>
</body>
</html>
