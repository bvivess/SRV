<?php
use models\Employee;

/** Escapa qualsevol valor abans de mostrar-lo en HTML. */
function employeeEscape($value): string {
    return htmlspecialchars((string) ($value ?? ''), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/** Retorna el valor d'un camp, prioritzant el que s'ha enviat si el formulari no és vàlid. */
function employeeValue(Employee $employee, string $field): string {
    if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST' && array_key_exists($field, $_POST)) {
        $value = $_POST[$field];
    } else {
        $value = $employee->$field;
    }

    if ($field === 'hire_date' && $value !== null && $value !== '') {
        $value = substr((string) $value, 0, 10);
    }

    return employeeEscape($value);
}

/** Construeix un Employee a partir del formulari i acumula els errors de validació. */
function employeeFromPost(?int $fixedId, array &$errors): Employee {
    $employeeId = $fixedId;

    if ($fixedId === null) {
        $rawId = trim((string) ($_POST['employee_id'] ?? ''));
        $validatedId = filter_var($rawId, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
        if ($validatedId === false) {
            $errors['employee_id'] = 'Enter a valid positive employee ID.';
        } else {
            $employeeId = (int) $validatedId;
        }
    }

    $firstName = trim((string) ($_POST['first_name'] ?? ''));
    $lastName = trim((string) ($_POST['last_name'] ?? ''));
    $email = trim((string) ($_POST['email'] ?? ''));
    $phoneNumber = trim((string) ($_POST['phone_number'] ?? ''));
    $hireDate = trim((string) ($_POST['hire_date'] ?? ''));
    $jobId = trim((string) ($_POST['job_id'] ?? ''));
    $rawSalary = trim((string) ($_POST['salary'] ?? ''));
    $rawCommission = trim((string) ($_POST['commission_pct'] ?? ''));

    if ($lastName === '') {
        $errors['last_name'] = 'Last name is required.';
    }
    if ($email === '' || filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $errors['email'] = 'Enter a valid email address.';
    }
    if ($hireDate === '') {
        $errors['hire_date'] = 'Hire date is required.';
    } else {
        $date = DateTimeImmutable::createFromFormat('!Y-m-d', $hireDate);
        $dateErrors = DateTimeImmutable::getLastErrors();
        if ($date === false || $date->format('Y-m-d') !== $hireDate ||
            ($dateErrors !== false && ($dateErrors['warning_count'] > 0 || $dateErrors['error_count'] > 0))) {
            $errors['hire_date'] = 'Enter a valid date.';
        }
    }
    if ($jobId === '') {
        $errors['job_id'] = 'Job ID is required.';
    }

    $salary = null;
    if ($rawSalary === '' || !is_numeric($rawSalary) || (float) $rawSalary < 0) {
        $errors['salary'] = 'Enter a valid non-negative salary.';
    } else {
        $salary = (float) $rawSalary;
    }

    $commissionPct = null;
    if ($rawCommission !== '') {
        if (!is_numeric($rawCommission) || (float) $rawCommission < 0 || (float) $rawCommission > 1) {
            $errors['commission_pct'] = 'Commission must be a number between 0 and 1.';
        } else {
            $commissionPct = (float) $rawCommission;
        }
    }

    $managerId = employeeOptionalId('manager_id', $errors);
    $departmentId = employeeOptionalId('department_id', $errors);

    return new Employee(
        $employeeId,
        $firstName === '' ? null : $firstName,
        $lastName === '' ? null : $lastName,
        $email === '' ? null : $email,
        $phoneNumber === '' ? null : $phoneNumber,
        $hireDate === '' ? null : $hireDate,
        $jobId === '' ? null : $jobId,
        $salary,
        $commissionPct,
        $managerId,
        $departmentId
    );
}

/** Valida un ID opcional (manager o departament). */
function employeeOptionalId(string $field, array &$errors): ?int {
    $rawValue = trim((string) ($_POST[$field] ?? ''));
    if ($rawValue === '') {
        return null;
    }

    $value = filter_var($rawValue, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    if ($value === false) {
        $errors[$field] = 'Enter a positive integer or leave this field empty.';
        return null;
    }

    return (int) $value;
}
