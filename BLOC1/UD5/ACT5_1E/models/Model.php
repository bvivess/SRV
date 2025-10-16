<?php

    namespace models;

    use config\Database;

    class Model {
            // Mètode per obtenir tots els registres de la taula
        public static function all() {
            // Connectar a la base de dades
            $db = new Database();
            $db->connectDB('C:/temp/config.db');

            // Obtenir el nom de la taula de la classe filla
            $table = static::$table;  

            // Executar la consulta
                // Es pot utilitzar aquesta consulta per obtenir informació de les columnes d'una taula
                // és a dir, els noms dels camps, tipus de dades, si poden ser NULL, etc.
                // Útil per fer tabmbé un mètode genèric de 'insert' o 'update' o 'delete'
                // SELECT *  FROM information_schema.columns 
                // WHERE table_schema = 'HR'
                // AND   table_name = 'JOBS';
            $sql = "SELECT * FROM $table";
            $result = $db->conn->query($sql);

            // Comprovar si hi ha resultats
			$rows = [];
            if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					// Crear un nou objecte de tipus 'Employee', 'Customer', ...
					$objecte = new static( ...array_values($row) );

					// Afegir l'objecte a l'array
					$rows[] = $objecte;
				}
            }

            // Tancar la connexió
            $db->closeDB();

            // Retornar els registres obtinguts
            return $rows;
        }
    }

?>
