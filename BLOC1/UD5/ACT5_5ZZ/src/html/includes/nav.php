<?php require_once dirname(__DIR__, 2) . '/config/config.php'; ?>

<nav id="menu" aria-label="Main navigation">
    <ul>
        <li><a href="<?= BASE_URL ?>/index.php">Home</a></li>
        <li>
            HR
            <ul>
                <li><a href="<?= BASE_URL ?>/src/html/employees/employees_list.php">Employees</a></li>
            </ul>
        </li>
    </ul>
</nav>
