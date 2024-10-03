<?php 
	require_once('Persona.php');
	require_once('Estudiant.php');
	require_once('Professor.php');
	// Crea un objecte '$estudiant'
	$estudiant = new Estudiant("Joan", 20, "Programació");
	$estudiant->mostraEstudiant();
	echo "<br>";
	// Crea un objecte '$professor'
	$professor = new Professor("Pere", 36);
	$professor->mostraProfessor();
?>
