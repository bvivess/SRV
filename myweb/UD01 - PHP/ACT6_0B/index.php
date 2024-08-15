<?php 
	require_once('Rectangle.php');
    $rectangle = new Rectangle;

    $rectangle->amplada = 3.0;
    $rectangle->alcada = 4.0;

    echo "Área: " . $rectangle->calcularArea() . " ". "Perímetre: " . $rectangle->calcularPerimetre();
?> 