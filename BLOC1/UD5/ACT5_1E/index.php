<?php
    spl_autoload_register( function($classe) {
        if (file_exists(str_replace('\\','/',$classe) . '.php'))
            require_once(str_replace('\\','/',$classe) . '.php');
    } );

    use Config\Database;
    use Models\Employee;
    use Models\Order_Item;

    try {
        $employees = Employee::all();  // SELECT
        echo '<pre>';
        foreach ($employees as $e) {
            echo json_encode($e, JSON_PRETTY_PRINT);
        }
        echo '</pre>';
        
        $order_items = Order_Item::all();  // SELECT
        echo '<pre>';
        foreach ($order_items as $oi) {
            echo json_encode($oi, JSON_PRETTY_PRINT);
        }
        echo '</pre>';
    } catch(\Exception $e) {
        echo "S'ha produït el següent error:" . "<br>" . $e->getMessage();
    }

    try {
        // Crear una nova instància d'Employee i assignar valors
        $oi = new Order_Item( 2354,
                              2289,
                              14,
                              29.01,
                              3 );
        // Guardar l'empleat a la base de dades
        $oi->save();  // INSERT / UPDATE
        $oi2 = new Order_Item( 2354,
                               2289 );
        $oi2->destroy();
        echo "OI guardat/eliminat correctament.<br>";   
    } catch(\Exception $e) {
        echo "S'ha produït el següent error:" . "<br>" . $e->getMessage();
    }

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
        echo "Empleat guardat correctament.<br>";   
    } catch(\Exception $e) {
        echo "S'ha produït el següent error:" . "<br>" . $e->getMessage();
    }

    echo '<br>';

    // Eliminar l'empleat de la base de dades
    try {
        $employee = new Employee(  1010 );
        $employee->destroy();

    } catch(\Error | \Exception $e) {
        echo "S'ha produït el següent error:" . "<br>" . $e->getMessage();
    }

?>

