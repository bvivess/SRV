<?php
    require_once('Coloreador.php');
    require_once('FiguraGeometrica.php');
    require_once('Cercle.php');
	require_once('Quadrat.php');
    // require_once('Quadrat.php');

    // Crear un objecte de la classe Cercle
    $cercle = new Cercle(radi:5.0); 
    $cercle->aplicaColor("Blau");
    echo $cercle->__toString();

	echo "<br>";

    // Crear un objecte de la classe Quadrat
    // ...
?>
