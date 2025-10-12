<?php
    // fitxer: demo_errors_php8.php

    function gestorErrors($errno, $errstr, $errfile, $errline) {
        // Paràmetres:
        //      $errno: codi d'error
        //      $errstr: missatge d'error
        //      $errfile: fitxer on s'ha produït l'error
        //      $errline: línia on s'ha produït l'error

        // Classificació de l'error
        switch ($errno) {
            case E_ERROR:
            case E_CORE_ERROR:
            case E_COMPILE_ERROR:
            case E_USER_ERROR:
            case E_RECOVERABLE_ERROR:
                $nivell = 'ERROR'; break;
            case E_WARNING:
            case E_CORE_WARNING:
            case E_COMPILE_WARNING:
            case E_USER_WARNING:
                $nivell = 'ADVERTÈNCIA';
                break;
            case E_NOTICE:
            case E_USER_NOTICE:
            case E_STRICT:
                $nivell = 'NOTIFICACIÓ'; break;
            case E_DEPRECATED:
            case E_USER_DEPRECATED:
                $nivell = 'DEPRECATED'; break;
            default:
                $nivell = 'DESCONEGUT'; break;
        }

        $missatge = "[" . date('Y-m-d H:i:s') . "] [$nivell:$errno] $errstr a $errfile (línia $errline)";

        echo "<p style='color: darkred; font-family: monospace;'>$missatge</p>";  // també 'throw new ErrorException($missatge);'

        error_log($missatge . PHP_EOL, 3, 'errors.log');

        return true; // 'true' per evitar el gestor d'errors per defecte de PHP
                     // 'false' per permetre el gestor d'errors per defecte de PHP
    }

    // Activem la gestió d'errors
    set_error_handler('gestorErrors');  // Activem el gestor personalitzat
    error_reporting(E_ALL); // Reportem tots els errors

    ini_set('display_errors', 0);   // Mostrar errors a pantalla
    echo  ini_get('display_errors'); // Mostrar errors a pantalla
    echo  ini_get('error_reporting'); // Mostrar errors a pantalla
 
    ini_set('log_errors', 1);     // Activar registre d'errors
    ini_set('error_log', 'errors.log'); // Fitxer de registre d'errors

    // ======================================================
    // Provem diferents tipus d'errors
    // ======================================================

    // 1.- E_NOTICE modern: clau d'array inexistent
    $array = ['nom' => 'Anna'];
    echo $array['email']; // E_WARNING en PHP 8.2+, abans podria ser 'E_NOTICE' depenent del context

    // 2.- E_WARNING: include de fitxer que no existeix
    include('fitxer_inexistent.php');   // 'E_WARNING'  

    // 3.- E_USER_WARNING: error creat per l'usuari
    trigger_error("Error advertència creat per usuari", E_USER_WARNING);  // 'E_USER_WARNING'

    // 4.- E_USER_NOTICE: notificació creada per l'usuari
    trigger_error("Notificació creat per usuari", E_USER_NOTICE);  // 'E_USER_NOTICE'

    // 5.- Divisió per zero tractat de diferents maneres
    try { 
        try {
            $divisor = 0;

            // 5.1- Genera 'DivisionByZeroError'
            $valor = 10 / $divisor; // Genera DivisionByZeroError
            
            // 5.2- Genera 'DivisionByZeroError'
            if ($divisor == 0) {
                throw new DivisionByZeroError("Divisió per zero no permesa.");  // Genera DivisionByZeroError
            }
            
            // 5.3- Genera 'Exception' personalitzada
            if ($divisor == 0) {
                trigger_error("Divisió per zero no permesa.", E_USER_WARNING); // Convertim l'error en un error gestionat
            }
        } catch (DivisionByZeroError $e) {
            throw new Exception("************** Excepció: Divisió per zero no permesa." . $e->getMessage());
        }
    } catch (Exception $e) {
        echo "<p style='color: darkred;'>❗ {$e->getMessage()}</p>"; // Convertim l'excepció en un error no gestionat
        trigger_error($e->getMessage(), E_USER_WARNING); // Convertim l'excepció en un error gestionat
    }

    echo "<p>El programa continua després de tractar errors i excepcions.</p>";
?>

