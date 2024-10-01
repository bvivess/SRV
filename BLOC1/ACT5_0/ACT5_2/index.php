<?php

    // Carregar les classes amb els namespaces

    use models\Employee;

    // Crear un nou objecte User i desar-lo (inserir-lo a la BD)
    /*$employee = new Employee( [ 'employee_id' => '1',
                                'name' => 'Tomeu Vives'
                              ]
                            );
    
    // Guardar el nou usuari a la base de dades
    $employee->save(); */
    
    // Recuperar tots els usuaris després de la inserció
    $employees = new Employee(1,'a');
    dd($employees);
    
    foreach ($employees as $e) {
        echo "ID: " . $e->id . "<br>";
        echo "Nom: " . $e->name . "<br>";
    }

?>
