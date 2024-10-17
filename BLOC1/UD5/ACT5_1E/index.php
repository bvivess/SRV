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

    try {
        // Crear una nova instància d'Employee i assignar valors
        $employee = new Employee(  1010,
                                "Tomeu",
                                "Vives",
                                "bvives@iemilidaraaaader.com",
                                "123456789",
                                "2024-01-01", 
                                "AD_VP",
                                60000.00,
                                0.05,
                                102,
                                60 );
        // Guardar l'empleat a la base de dades
        $employee->save();  // INSERT / UPDATE
    } catch(Exception $e) {
        echo $e->getMessage();
    }

    // Eliminar l'empleat de la base de dades
    $employee = new Employee(  1010 );
    $employee->destroy();

    $employees = Employee::all();  // SELECT
    echo '<pre>';
    foreach ($employees as $employee) {
        echo json_encode($employee, JSON_PRETTY_PRINT);
    }
    echo '</pre>';

?>

