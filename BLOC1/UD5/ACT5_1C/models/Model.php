<?php

    namespace models;

    use config\Database;

    class Model {
            // Mètode per obtenir tots els registres de la taula
        public static function all() {
            // Carregar la connexió a la base de dades
            $config = Database::loadConfig('C:/temp/config.db');
            $db = new Database(
                $config['DB_HOST'], 
                $config['DB_PORT'], 
                $config['DB_DATABASE'], 
                $config['DB_USERNAME'], 
                $config['DB_PASSWORD']
            );

            // Connectar a la base de dades
            $db->connectDB();

            // Obtenir el nom de la taula de la classe filla
            $table = static::$table;  

            // Executar la consulta
            $sql = "SELECT * FROM $table";
            $result = $db->conn->query($sql);

            // Comprovar si hi ha resultats
			$rows = [];
            if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					// Crear un nou objecte de tipus 'Employee', 'Customer', ...
					$employee = new static( ...array_values($row) );

					// Afegir l'objecte a l'array
					$rows[] = $employee;
				}
            }

            // Tancar la connexió
            $db->closeDB();

            // Retornar els registres obtinguts
            return $rows;
        }
    }

?>
