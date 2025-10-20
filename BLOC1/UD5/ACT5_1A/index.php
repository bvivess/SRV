<?php

    // Incloure l'arxiu de configuració i carregar la classe 'Database
    spl_autoload_register( function($classe) {
        if (file_exists(str_replace('\\','/',$classe) . '.php'))
            require_once(str_replace('\\','/',$classe) . '.php');
    } );

    use Models\Employee;

    $employees = Employee::all();  // SELECT
    echo '<pre>';
    foreach ($employees as $employee) {
        echo json_encode($employee, JSON_PRETTY_PRINT);
    }
    echo '</pre>';


?>

