<?php
	require_once 'FiguraGeometrica.php';
	require_once 'Cercle.php';
	require_once 'Quadrat.php';

	$figures = [];

	// Crear i afegir el cercle
	$figura = new Cercle(5.0);
	$figures[] = $figura;  // afegeix a l'array

	// Crear i afegir el quadrat
	$figura = new Quadrat(5.0);
	$figures[] = $figura;  // afegeix a l'array

	// Recorre les figures i mostra la seva àrea
	foreach ($figures as $figura) {
		if ($figura instanceof Cercle)
			echo "A continuació es mostrarà un Cercle: ";
		elseif ($figura instanceof Quadrat)
			echo "A continuació es mostrarà un Quadrat: ";
		
		echo $figura->__toString() . "<br>";
	}
?>