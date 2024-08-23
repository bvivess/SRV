<?php 
	require_once('Persona.php');
    $persona1 = new Persona("Joan", 20);
    $persona2 = new Persona(edat: 23, nom: "Maria");

    echo "Nom: " . $persona1->nom . " ". "Edat: " . $persona1->edat . "<br>";
    echo "Nom: " . $persona2->nom . " ". "Edat: " . $persona2->edat;
?> 