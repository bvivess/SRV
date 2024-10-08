<?php
	require_once 'FiguraGeometrica.php';
	require_once 'Cercle.php';
	require_once 'Quadrat.php';

	$figures = [];

	// Crear i afegir el cercle
	$figura = new Cercle(5.0);
	$figures[] = $figura;

	// Crear i afegir el quadrat
	$figura = new Quadrat(5.0);
	$figures[] = $figura;

	// Recorre les figures i mostra la seva àrea
	foreach ($figures as $figura) {
		echo $figura->__toString() . "<br>";
	}
?>