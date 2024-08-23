<?php
    require_once('FiguraGeometrica1.php');
    require_once('Cercle.php');
    require_once('Quadrat.php');
    // Crear un objecte de la classe Cercle i un de la classe Quadrat
    $cercle = new Cercle(5.0);
    $quadrat = new Quadrat(25.0);

    echo "Àrea del cercle: " . $cercle->calculaArea() . "<br>"; 
    echo "Àrea del quadrat: " . $quadrat->calculaArea(); 
?>
