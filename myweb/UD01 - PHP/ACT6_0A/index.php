<?php
    require_once('Persona.php');
    $persona = new Persona;  // Instanciació

    $persona->nom = "Joan";
    $persona->llinatge1 = "Martínez";
    $persona->llinatge2 = "Fernández";
    $persona->edat = 26;
    $persona->mostraPersona();
?>