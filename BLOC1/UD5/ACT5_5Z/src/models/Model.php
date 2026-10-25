<?php

    namespace models;

    use config\Database;

    abstract class Model {
        // Mètodes abstractes per a les operacions(Create, Update, Delete) del CRUD
        public abstract function save();
        public abstract function destroy();

        // Mètode concret per a l'operació Read (Select) del CRUD
        public static function all() : array {
            try {
                // Connectar a la base de dades
                $db = new Database();
                $db->connectDB('C:/temp/config.db');

                // Obtenir el nom de la taula de la classe filla
                $table = static::$table;  

                // Obtenir els noms de les columnes de la taula
                $columns = implode(', ', self::getTableColumns($db, $table));  // COL1 COL2 COL3 --> COL1, COL2, COL3

                // Construir la consulta amb els noms de les columnes
                $sql = "SELECT $columns FROM $table ORDER BY 1"; // Ordenar pel primer camp (normalment la clau primària)
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

                // Retornar els registres obtinguts
                return $rows;
            } catch (\mysqli_sql_exception $e) {
                throw new \mysqli_sql_exception($e->getMessage()); 
            } finally {
                if ($db->conn)
                    // Tancar la connexió
                    $db->closeDB(); 
            } 
        }

        // Mètode concret per a l'operació Read (Select ... where id = $id) del CRUD
        public static function find(int $id): static|null {
            try {
                // Connectar a la base de dades
                $db = new Database();
                $db->connectDB('C:/temp/config.db');

                // Obtenir el nom de la taula de la classe filla 
                $table = static::$table;

                // Obtenir la clau primària de la taula
                $primaryKey = self::getPrimaryKey($db, $table);
                if ($primaryKey === null) {
                    throw new \RuntimeException("No s'ha pogut trobar la clau primària de la taula $table.");
                }

                // Obtenir els noms de les columnes de la taula
                $columns = implode(', ', self::getTableColumns($db, $table));  // COL1 COL2 COL3 --> COL1, COL2, COL3

                // Construir la consulta amb els noms de les columnes
                $sql = "SELECT $columns FROM $table WHERE $primaryKey = ? ORDER BY 1"; // Ordenar pel primer camp (normalment la clau primària)
                $stmt = $db->conn->prepare($sql);
                $stmt->bind_param('i', $id);
                $stmt->execute();
                $row = $stmt->get_result()->fetch_assoc();
                
                return $row === null ? null : new static(...array_values($row));
            } catch (\mysqli_sql_exception $e) {
                throw new \mysqli_sql_exception($e->getMessage());
            } finally {
                if ($db->conn)
                    // Tancar la connexió
                    $db->closeDB();
            }
        }

        // Mètode per obtenir els noms de les columnes d'una taula
        public static function getTableColumns($db, $table) : array {
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
        public static function getPrimaryKey($db, $table) {
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
        public static function getParamTypes(array $values) : string {
            $types = '';
            foreach ($values as $v)
                if (is_int($v))
                    $types .= 'i';
                elseif (is_float($v))
                    $types .= 'd';
                else
                    $types .= 's';

            return $types;
        }

    }

?>
