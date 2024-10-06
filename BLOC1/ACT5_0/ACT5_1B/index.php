<?php

    // Incloure l'arxiu de configuració i carregar la classe 'Database'
    require_once __DIR__ . '/config/database.php';

    use Config\Database;

    // Definim la ruta del fitxer de configuració
    const CONFIG_FILE = 'C:/temp/config.db';

    // Carreguem les variables de configuració
    $config = Database::loadConfig(CONFIG_FILE);

    // Mostrem l'array de configuració
    echo '<pre>';
    print_r($config);  // en comptes d'un foreach, també 'var_dump'
    echo '</pre>';

    // Crear una instància de la classe 'Database' amb els valors de configuració
    $db = new Database(
        $config['DB_HOST'], 
        $config['DB_PORT'], 
        $config['DB_DATABASE'], 
        $config['DB_USERNAME'], 
        $config['DB_PASSWORD']
    );

    // Realitzar la connexió a la base de dades
    $db->connectDB();

    // Operacions amb la base de dades...

    // Tancar la connexió a la base de dades
    $db->closeDB();

?>

