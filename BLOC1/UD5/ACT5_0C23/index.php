<?php
    // Activar excepciones de MySQLi
    //mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    // Datos de conexión
    define('HOST', '192.168.1.12');
    define('DBNAME', 'HR');
    define('USERNAME', 'HR');
    define('PASSWD', 'Educacio123!');

    try {
        // Crear conexión orientada a objetos
        $conn = new mysqli(HOST, USERNAME, PASSWD, DBNAME);
        echo "<p>Conexión OK a la base de datos.</p>";

        // Consulta
        $query = 'SELECT employee_id, last_name, first_name FROM employees ORDER BY employee_id';
        $result = $conn->query($query);

        // Mostrar resultados
        while ($row = $result->fetch_assoc()) {
            echo $row['employee_id'] . " " . $row['last_name'] . " " . $row['first_name'] . "<br>";
        }

    } catch (mysqli_sql_exception $e) {
        // Captura errores de conexión o consulta
        echo "<p>*************************Error de MySQLi: " . $e->getMessage() . "</p>";
    } finally {
        // Cerrar conexión si existe
        if (isset($conn) && $conn instanceof mysqli) {
            $conn->close();
            echo "<p>Conexión cerrada.</p>";
        }
    }
?>


