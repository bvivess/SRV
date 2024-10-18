<?php

    namespace config;

    class Database {
        public $conn;

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
        public function connectDB($configPath) {
            // Cridar a l'arxiu
            $config = self::loadConfig($configPath);

            // Connectar a la base de dades
            $this->conn = new \mysqli($config['DB_HOST'], $config['DB_USERNAME'], $config['DB_PASSWORD'], $config['DB_DATABASE'], $config['DB_PORT']);
            $this->conn->autocommit(false);
            $this->conn->begin_transaction();


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
