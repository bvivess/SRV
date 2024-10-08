<?php

    // Incloure l'arxiu de configuració i carregar la classe 'Config'
    require_once __DIR__ . '/config/Database.php';

    use Config\Database;

    // Definim la ruta del fitxer de configuració
    const CONFIG_FILE = 'C:/temp/config.db';

    // Carreguem les variables de configuració
    $config = Database::loadConfig(CONFIG_FILE);

    // Mostrem l'array de configuració
    echo '<pre>';
    print_r($config);  // en comptes d'un foreach, també 'var_dump'
    echo '</pre>';

?>
