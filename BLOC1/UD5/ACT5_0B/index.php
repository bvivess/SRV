<?php 
    // Incloure els arxius manualment (en la pràctica,emprar 'autoloader')
    require_once('Databases\MySQL\Database.php');
    require_once('Databases\Oracle\Database.php');

    // Emprar les classes del 'namespace' 'Databases\MySQL' i 'Databases\Oracle'
    use Databases\MySQL\Database as DBMySQL;
    use Databases\Oracle\Database as DBOracle;

    // Instanciar y usar las clases
    $dbMySQL = new DBMySQL();
    $dbMySQL->connectar();
    $dbMySQL->desconnectar();

    $dbOracle = new DBOracle();
    $dbOracle->connectar();
    $dbOracle->desconnectar();
?>
