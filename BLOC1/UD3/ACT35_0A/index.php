<?php
    require_once('Cercle.php');
    require_once('Quadrat.php');
    // Crear un objecte de la classe Cercle
    $cercle = new Cercle(radi:5.0);
	$cercle->aplicaColor("Verd");
    echo $cercle->__toString() . "<br>"; 

    $quadrat = new Quadrat(costat:10.0);
	$quadrat->aplicaColor("Blau");
    echo $quadrat->__toString() . "<br>";

?>
