<?php

    namespace models;

    use config\config;

    class Model {
        protected static $table; // = __CLASS__;

        // Connexió a la base de dades utilitzant mysqli i carregant les dades des de config
        protected static function getConnection() {
            $config = Config::loadConfig(__DIR__ . '/../config/config.db');

            $host = $config['DB_HOST'];
            $dbname = $config['DB_DATABASE'];
            $username = $config['DB_USERNAME'];
            $password = $config['DB_PASSWORD'];
            $port = $config['DB_PORT'];

            // Connexió amb mysqli (POO)
            $conn = new \mysqli($host, $username, $password, $dbname, $port);

            // Comprovar si hi ha errors en la connexió
            if ($conn->connect_error) {
                die("Error en la connexió: " . $conn->connect_error);
            }

            return $conn;
        }

        // Mètode per obtenir tots els registres de la taula
        public static function all() {
            $conn = static::getConnection();
            $table = static::$table;

            $query = "SELECT * FROM $table";
            $result = $conn->query($query);

            if ($result === false) {
                die("Error en la consulta: " . $conn->error);
            }

            $objects = [];
            while ($row = $result->fetch_assoc()) {
                $objects[] = new static($row);
            }

            $conn->close();
            return $objects;
        }
    }

?>
