<?php

    namespace App\Database;

    class Database {
        private $host;
        private $port;
        private $database;
        private $username;
        private $password;
        private $conn;

        public function __construct($configFile) {
            // Llegeix el fitxer de configuració
            if (!file_exists($configFile)) {
                throw new Exception("El fitxer de configuració no existeix.");
            }

            $config = $this->parseConfigFile($configFile);

            // Assigna les variables de configuració
            $this->host = $config['DB_HOST'];
            $this->port = $config['DB_PORT'];
            $this->database = $config['DB_DATABASE'];
            $this->username = $config['DB_USERNAME'];
            $this->password = $config['DB_PASSWORD'];
        }

        // Funció per parsejar el fitxer de configuració
        private function parseConfigFile($file) {
            /* EXEMPLE: config.db
                DB_CONNECTION=mysql
                DB_HOST=127.0.0.1
                DB_PORT=3306
                DB_DATABASE=HR
                DB_USERNAME=root
                DB_PASSWORD=
            */
            $config = [];

            // Llegeix cada línia del fitxer
            $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                // Ignorar línies de comentari
                if (strpos(trim($line), '#') != 0) {
                    // Divideix cada línia en clau i valor
                    list($key, $value) = explode('=', $line, 2);
                    $config[trim($key)] = trim($value);
                }
            }

            return $config;
        }

        // Connexió a la base de dades amb mysqli POO
        public function connect() {
            // Estableix la connexió a la base de dades
            $this->conn = new mysqli(
                $this->host,
                $this->username,
                $this->password,
                $this->database,
                $this->port
            );

            // Comprova si hi ha errors en la connexió
            if ($this->conn->connect_error) {
                die("Error de connexió: " . $this->conn->connect_error);
            }

            echo "Connexió establerta correctament.";
        }

        // Tanca la connexió a la base de dades
        public function close() {
            if ($this->conn) {
                $this->conn->close();
                echo "Connexió tancada.";
            }
        }
    }

?>
