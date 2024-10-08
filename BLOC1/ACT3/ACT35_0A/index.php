<?php
    require_once('Cercle.php');
    require_once('Quadrat.php');
    // Crear un objecte de la classe Cercle
    $cercle = new Cercle(radi:5.0);
	$cercle->aplicaColor("Verd");
    echo "Àrea del " . $cercle->__toString() . ": Color: " . $cercle->getColor() . ": ". $cercle->calculaArea() . "<br>"; 

    $quadrat = new Quadrat(costat:10.0);
	$quadrat->aplicaColor("Verd");
    echo "Àrea del " . $quadrat->__toString() . ": Color: " . $quadrat->getColor() . ": ". $quadrat->calculaArea();

?>
