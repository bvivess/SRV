<?php

    namespace config;

    class Database {
        public $host;
        public $port;
        public $database;
        public $username;
        public $password;
        public $conn;

        // Constructor que utilitza el mètode 'loadConfig' per carregar les dades de configuració
        public function __construct($host, $port, $database, $username, $password) {
            $this->host = $host;
            $this->port = $port;
            $this->database = $database;
            $this->username = $username;
            $this->password = $password;
        }

        // Mètode per carregar la configuració des del fitxer
        public static function loadConfig($fitxer): array {
            $config = [];  // Inicialitzem un array buit per emmagatzemar les variables

            // Verifiquem que el fitxer existeix
            if (file_exists($fitxer)) {
                // Llegim el fitxer línia per línia
                $linies = file($fitxer, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                
                // Recorrer cada línia del fitxer
                foreach ($linies as $linia) {
                    // Comprovam si la línia és un comentari
                    $linia = trim($linia);
                    if (strpos(trim($linia), '#') !== 0) {
                        list($clau, $valor) = explode('=', $linia, 2);
                        $config[trim($clau)] = trim($valor); // Emmagatzemem clau i valor a l'array associatiu
                    }
                }
            } else {
                die("El fitxer de configuració no existeix.");
            }

            // Retornam l'array associatiu amb les variables del fitxer
            return $config;
        }

        // Mètode per connectar-se a la base de dades
        public function connectDB() {
            $this->conn = new \mysqli($this->host, $this->username, $this->password, $this->database, $this->port);

            // Comprovem si hi ha errors en la connexió
            if ($this->conn->connect_error) {
                die("Error en la connexió: " . $this->conn->connect_error);
            }
        }

        // Mètode per tancar la connexió a la base de dades
        public function closeDB() {
            if ($this->conn) {
                $this->conn->close();
            }
        }
    }

?>
