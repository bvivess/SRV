<?php

    namespace Config;

    class Config {
        public static function loadConfig($filename) {
            $config = [];
            
            if (file_exists($filename)) {
                $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                foreach ($lines as $line) {
                    if (strpos(trim($line), '#') != 0) {
                        list($name, $value) = explode('=', $line, 2);
                        $config[trim($name)] = trim($value);
                    }
                }
            } else {
                die("El fitxer de configuració no existeix.");
            }

            return $config;
        }
    }

?>
