<?php
    require_once('Cercle.php');
    require_once('Quadrat.php');
    // Crear un objecte de la classe Cercle
    $cercle = new Cercle("Vermell", 5.0);
    // Crear un objecte de la classe Quadrat
    $quadrat = new Quadrat("Verd", 10.0);

    echo  "Àrea del " . $cercle->nomFigura() . ": ". $cercle->calculaArea() . "<br>";
    echo  "Àrea del " . $quadrat->nomFigura() . ": ". $quadrat->calculaArea();
?>

