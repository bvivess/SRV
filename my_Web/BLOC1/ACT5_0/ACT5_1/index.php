<?php
    // Importa les classes amb `use`
    use App\Database\Database;
    use App\Models\Employee;
    
    // Ús del programa
    try {
        // Crea una nova connexió a la base de dades
        $dbConnection = new Database('config.db');
        $connection = $dbConnection->connect();

        // Crea un nou objecte Employee
        $employee = new Employee(100, 'Tomeu Vives', $connection);

        // Guarda l'empleat a la base de dades
        $employee->save();

        // Tanca la connexió
        $dbConnection->close();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

?>
