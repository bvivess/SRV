<?php
    // Now, only 'WARNINGS' are reported
    error_reporting(E_WARNING); // Reportem només 'warnings'

    ini_set('display_errors', true);   // Mostrar errors a pantalla
    echo  ini_get('display_errors'); // Mostrar errors a pantalla
    echo  ini_get('error_reporting'); // Mostrar errors a pantalla

    try {
        $var = 10 / 0; 
    } catch(Exception $e) {
        // No Error catched
        echo "A 'catch(Exception)' is not necessary"; 
    }
?>
