<?php

    namespace Config;

    class Database {
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
    }

?>
