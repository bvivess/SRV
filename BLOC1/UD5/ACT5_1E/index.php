<?php
    spl_autoload_register( function($classe) {
        if (file_exists(str_replace('\\','/',$classe) . '.php'))
            require_once(str_replace('\\','/',$classe) . '.php');
    } );

    use Config\Database;
    use Models\Employee;

    try {
        $employees = Employee::all();  // SELECT
        echo '<pre>';
        foreach ($employees as $employee) {
            echo json_encode($employee, JSON_PRETTY_PRINT);
        }
        echo '</pre>';
    } catch(\Exception $e) {
        echo "S'ha produït el següent error:" . "<br>" . $e->getMessage();
    }
/*
    try {
        // Crear una nova instància d'Employee i assignar valors
        $employee = new Employee( 1010,
                                "Tomeu",
                                "Vives",
                                "bvives@iesemilidarder.com",
                                "123456789",
                                "2024-01-01", 
                                "AD_VP",
                                60000.00,
                                0.05,
                                null,
                                60 );
        // Guardar l'empleat a la base de dades
        $employee->save();  // INSERT / UPDATE
    } catch(\Exception $e) {
        echo "S'ha produït el següent error:" . "<br>" . $e->getMessage();
    }

    echo '<br>';

    // Eliminar l'empleat de la base de dades
    try {
        $employee = new Employee(  100 );
        $employee->destroy();
    } catch(\Exception $e) {
        echo "S'ha produït el següent error:" . "<br>" . $e->getMessage();
    }
  
    $employees = Employee::all();  // SELECT
    echo '<pre>';
    foreach ($employees as $employee) {
        echo json_encode($employee, JSON_PRETTY_PRINT);
    }
    echo '</pre>';
*/
?>

