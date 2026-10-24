<div class="form-row">
    <div class="form-group col-md-3">
        <label for="employee_id">Employee ID</label>
        <input type="number" min="1" id="employee_id" name="employee_id"
               class="form-control <?= isset($errors['employee_id']) ? 'is-invalid' : '' ?>"
               value="<?= $isNew ? employeeValue($employee, 'employee_id') : employeeEscape($employee->employee_id) ?>"
               <?= $isNew ? 'required' : 'readonly' ?>>
        <?php if (isset($errors['employee_id'])): ?>
            <div class="invalid-feedback"><?= employeeEscape($errors['employee_id']) ?></div>
        <?php endif; ?>
    </div>
    <div class="form-group col-md-4">
        <label for="first_name">First Name</label>
        <input type="text" id="first_name" name="first_name" maxlength="20"
               class="form-control <?= isset($errors['first_name']) ? 'is-invalid' : '' ?>"
               value="<?= employeeValue($employee, 'first_name') ?>">
        <?php if (isset($errors['first_name'])): ?>
            <div class="invalid-feedback"><?= employeeEscape($errors['first_name']) ?></div>
        <?php endif; ?>
    </div>
    <div class="form-group col-md-5">
        <label for="last_name">Last Name *</label>
        <input type="text" id="last_name" name="last_name" maxlength="25" required
               class="form-control <?= isset($errors['last_name']) ? 'is-invalid' : '' ?>"
               value="<?= employeeValue($employee, 'last_name') ?>">
        <?php if (isset($errors['last_name'])): ?>
            <div class="invalid-feedback"><?= employeeEscape($errors['last_name']) ?></div>
        <?php endif; ?>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="email">Email *</label>
        <input type="email" id="email" name="email" maxlength="25" required
               class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
               value="<?= employeeValue($employee, 'email') ?>">
        <?php if (isset($errors['email'])): ?>
            <div class="invalid-feedback"><?= employeeEscape($errors['email']) ?></div>
        <?php endif; ?>
    </div>
    <div class="form-group col-md-6">
        <label for="phone_number">Phone Number</label>
        <input type="text" id="phone_number" name="phone_number" maxlength="20"
               class="form-control <?= isset($errors['phone_number']) ? 'is-invalid' : '' ?>"
               value="<?= employeeValue($employee, 'phone_number') ?>">
        <?php if (isset($errors['phone_number'])): ?>
            <div class="invalid-feedback"><?= employeeEscape($errors['phone_number']) ?></div>
        <?php endif; ?>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-4">
        <label for="hire_date">Hire Date *</label>
        <input type="date" id="hire_date" name="hire_date" required
               class="form-control <?= isset($errors['hire_date']) ? 'is-invalid' : '' ?>"
               value="<?= employeeValue($employee, 'hire_date') ?>">
        <?php if (isset($errors['hire_date'])): ?>
            <div class="invalid-feedback"><?= employeeEscape($errors['hire_date']) ?></div>
        <?php endif; ?>
    </div>
    <div class="form-group col-md-4">
        <label for="job_id">Job ID *</label>
        <input type="text" id="job_id" name="job_id" maxlength="10" required
               class="form-control <?= isset($errors['job_id']) ? 'is-invalid' : '' ?>"
               value="<?= employeeValue($employee, 'job_id') ?>">
        <?php if (isset($errors['job_id'])): ?>
            <div class="invalid-feedback"><?= employeeEscape($errors['job_id']) ?></div>
        <?php endif; ?>
    </div>
    <div class="form-group col-md-4">
        <label for="salary">Salary *</label>
        <input type="number" id="salary" name="salary" min="0" step="0.01" required
               class="form-control <?= isset($errors['salary']) ? 'is-invalid' : '' ?>"
               value="<?= employeeValue($employee, 'salary') ?>">
        <?php if (isset($errors['salary'])): ?>
            <div class="invalid-feedback"><?= employeeEscape($errors['salary']) ?></div>
        <?php endif; ?>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-4">
        <label for="commission_pct">Commission (0–1)</label>
        <input type="number" id="commission_pct" name="commission_pct" min="0" max="1" step="0.01"
               class="form-control <?= isset($errors['commission_pct']) ? 'is-invalid' : '' ?>"
               value="<?= employeeValue($employee, 'commission_pct') ?>">
        <?php if (isset($errors['commission_pct'])): ?>
            <div class="invalid-feedback"><?= employeeEscape($errors['commission_pct']) ?></div>
        <?php endif; ?>
    </div>
    <div class="form-group col-md-4">
        <label for="manager_id">Manager ID</label>
        <input type="number" id="manager_id" name="manager_id" min="1"
               class="form-control <?= isset($errors['manager_id']) ? 'is-invalid' : '' ?>"
               value="<?= employeeValue($employee, 'manager_id') ?>">
        <?php if (isset($errors['manager_id'])): ?>
            <div class="invalid-feedback"><?= employeeEscape($errors['manager_id']) ?></div>
        <?php endif; ?>
    </div>
    <div class="form-group col-md-4">
        <label for="department_id">Department ID</label>
        <input type="number" id="department_id" name="department_id" min="1"
               class="form-control <?= isset($errors['department_id']) ? 'is-invalid' : '' ?>"
               value="<?= employeeValue($employee, 'department_id') ?>">
        <?php if (isset($errors['department_id'])): ?>
            <div class="invalid-feedback"><?= employeeEscape($errors['department_id']) ?></div>
        <?php endif; ?>
    </div>
</div>
