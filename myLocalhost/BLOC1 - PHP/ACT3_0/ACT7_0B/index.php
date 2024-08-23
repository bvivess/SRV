<?php 
	require_once('Persona.php');
    $persona = new Persona("Joan", 20);  // Inicialització

    echo $persona->__toString() . "<br>";

    $persona->setNom("Pere")  // Modificació emprant 'Fluent interfaces'
            ->setEdat(26);

    echo $persona->__toString();
?> 