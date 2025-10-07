<?php
	function calculaArea($figura) {  // El tipat de l'argument s'ha eliminat si es vol emprar un 'trait'
		return $figura->calculaArea();  // Polimorfisme: s'executa el mètode específic de la classe concreta
	}

	require_once 'FiguraGeometrica.php';
	require_once 'Cercle.php';
	require_once 'Quadrat.php';

	// Crear i afegir el cercle
	$figura1 = new Cercle(5.0);
	$figura2 = new Quadrat(5.0);

	echo $figura1->__toString() . "<br>";
	echo "L'area de la figura1 és: " . calculaArea($figura1) . "<br>";
	echo $figura2->__toString() . "<br>";
	echo "L'area de la figura2 és: " . calculaArea($figura2) . "<br>";
?>