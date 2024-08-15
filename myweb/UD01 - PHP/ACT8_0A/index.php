<?php 
	require_once('Persona.php');
	require_once('Estudiant.php');
    // Crea un objecte '$estudiant'
    $estudiant = new Estudiant("Joan", 20, "Programació");
    // Mostrar les dades d''$estudiant'
    $estudiant->mostraEstudiant();
?>
