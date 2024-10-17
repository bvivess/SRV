<?php

    // Incloure l'arxiu de configuració i carregar la classe 'Database'
    //require_once __DIR__ . '/config/Database.php';
    //require_once __DIR__ . '/models/Model.php';
    //require_once __DIR__ . '/models/Employee.php';

    spl_autoload_register( function($classe) {
        if (file_exists(str_replace('\\','/',$classe) . '.php'))
            require_once(str_replace('\\','/',$classe) . '.php');
    } );

    use Config\Database;
    use Models\Employee;
    use Models\Customer;

    $employees = Employee::all();  // SELECT
    echo '<pre>';
    foreach ($employees as $employee) {
        echo json_encode($employee, JSON_PRETTY_PRINT);
    }
    echo '</pre>';

    $customers = Customer::all();  // SELECT
    echo '<pre>';
    print_r($customers);  // en comptes d'un foreach
    echo '</pre>';

?>

