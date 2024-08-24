<?php 
    use Databases\MySQL\Database as DBMySQL;
    use Databases\Oracle\Database as DBOracle;
    
    spl_autoload_register(function($classe) {
        if (file_exists(str_replace('\\','/',$classe) . '.php'))
            require_once (str_replace('\\','/',$classe) . '.php');

    });

    // Instanciar y usar las clases
    $dbMySQL = new DBMySQL();
    $dbMySQL->connectar(); 

    $dbOracle = new DBOracle();
    $dbOracle->connectar();
?>
