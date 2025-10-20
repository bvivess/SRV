<?php

    namespace models;

    use config\Database;

    abstract class Model {
        // Mètodes abstractes per a les operacions(Create, Update, Delete) del CRUD
        public abstract function save();
        public abstract function destroy();

        // Mètode concret per a l'operació Read (Select) del CRUD
        public static function all() : array {
            // Connectar a la base de dades
            $db = new Database();
            $db->connectDB('C:/temp/config.db');

            // Obtenir el nom de la taula de la classe filla
            $table = static::$table;  

            // Obtenir els noms de les columnes de la taula
            $columns = implode(', ', self::getTableColumns($db, $table)); 
            $columnspk = implode(' AND ', self::getTableColumns($db, $table)); 

            // Construir la consulta amb els noms de les columnes
            $sql = "DELETE FROM  $table WHERE $columnspk"; // Ordenar pel primer camp (normalment la clau primària)
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

        // Mètode per obtenir els noms de les columnes d'una taula
        private static function getTableColumns($db, $table) : array {
            // Obtenir el nom de la base de dades actual
            $databaseName = $db->conn->query("SELECT DATABASE()")->fetch_row()[0];

            // Consulta al diccionari de dades de MySQL
            $sql = "SELECT column_name 
                    FROM information_schema.columns 
                    WHERE table_schema = '$databaseName' 
                    AND table_name = '$table' 
                    ORDER BY ordinal_position";

            $result = $db->conn->query($sql);

            $columns = [];
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $columns[] = $row['COLUMN_NAME'];
                }
            }

            return $columns;
        }

        // --- Obtenir el nom de la primary key ---
        private function getPrimaryKey($db, $table) {
            // Obtenir el nom de la base de dades actual
            $databaseName = $db->conn->query("SELECT DATABASE()")->fetch_row()[0];
            // Consulta al diccionari de dades de MySQL
            $sql = "SELECT column_name 
                    FROM information_schema.key_column_usage 
                    WHERE table_schema = '$databaseName' 
                    AND table_name = '$table' 
                    AND constraint_name = 'PRIMARY'";
            $result = $db->conn->query($sql);
            $row = $result->fetch_assoc();
            
            return $row['COLUMN_NAME'] ?? null;
        }

        // --- Determinar tipus de paràmetres per bind_param ---
        private static function getParamTypes(array $values) : string {
            $types = '';
            foreach ($values as $v) {
                if (is_int($v)) $types .= 'i';
                elseif (is_float($v)) $types .= 'd';
                else $types .= 's';
            }
            return $types;
        }

    }

?>
