<?php
    require_once('FiguraGeometrica.php');
    require_once('Cercle.php');
    require_once('Quadrat.php');
    // Crear un objecte de la classe Cercle
    $cercle = new Cercle("Vermell", 5.0);
    echo $cercle->__toString(); 

	echo "<br>"; 

    $quadrat = new Quadrat("Verd", 10.0);
    echo $quadrat->__toString();  

?>
