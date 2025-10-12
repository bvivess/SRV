<?php
    // 1️⃣ Definim el gestor d'errors personalitzat
    function gestorErrors($errno, $errstr, $errfile, $errline) {
        // Missatge base d'error
        $missatge = "[" . date('Y-m-d H:i:s') . "] ";

        switch ($errno) {
            case E_USER_ERROR:
            case E_ERROR:
                $missatge .= "❌ [ERROR FATAL] $errstr a $errfile (línia $errline)";
                break;

            case E_WARNING:
            case E_USER_WARNING:
                $missatge .= "⚠️ [ADVERTIMENT] $errstr a $errfile (línia $errline)";
                break;

            case E_NOTICE:
            case E_USER_NOTICE:
                $missatge .= "ℹ️ [NOTÍCIA] $errstr a $errfile (línia $errline)";
                break;

            default:
                $missatge .= "🔸 [ALTRE] $errstr a $errfile (línia $errline)";
                break;
        }

        // Mostrem per pantalla (només durant desenvolupament)
        echo "<p style='color: darkred; font-family: monospace;'>$missatge</p>";

        // Guardem al fitxer de log
        error_log($missatge . PHP_EOL, 3, 'errors.log');

        return true;  // 'true' --> l'error ja ha estat gestionat, 
                      // 'false' --> cal gestionar l'error amb el sistema d'errors per defecte
    }

    // 2️⃣ Activem el gestor d'errors personalitzat
    set_error_handler('gestorErrors');

    // 3️⃣ Definim el nivell d'errors que volem detectar
    error_reporting(E_ALL);

    // 4️⃣ Provem diferents tipus d'errors
    echo $variableInexistent;                // E_NOTICE
    include('fitxer_que_no_existeix.php');  // E_WARNING
    trigger_error("Error personalitzat!", E_USER_WARNING);

    // Error fatal simulat (divisió per zero)
    $valor = 10 / 0; // E_WARNING en PHP 8+
?>