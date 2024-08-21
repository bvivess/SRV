<?php 
    require_once('Quadrat.php');
    $quadrat = (new Quadrat(0))  // crear una instància de 'Quadrat'
                   ->setCostat(10)  // modifica el valor de 'costat'
                   ->calculaArea() // calcula l'área  
                   ->calculaPerimetre()  // calcular el 'perímetre'
                   ->calculaNCostats();  // calcular el número de 'costats'
    echo $quadrat->__toString();  // mostrar les propietats
 ?>