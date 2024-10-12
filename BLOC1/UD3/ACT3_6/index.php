<?php
    require_once('Cercle.php');
    require_once('Quadrat.php');
    // Crear un objecte de la classe Cercle
    $cercle = new Cercle("Vermell", 5.0);
    // Crear un objecte de la classe Quadrat
    $quadrat = new Quadrat("Verd", 10.0);

    echo  "L'àrea del " . $cercle->__toString() . " és ". $cercle->calculaArea() . "<br>";
    echo  "L'àrea del " . $quadrat->__toString() . " és ". $quadrat->calculaArea();
?>

