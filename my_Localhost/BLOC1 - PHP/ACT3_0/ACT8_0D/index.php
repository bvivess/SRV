<?php 
	require_once('Persona.php');
	require_once('Estudiant.php');
    $e1 = new Estudiant("Joan", 20, "Programació");
    $e2 = new Estudiant("Aina", 31, "Programació");

    $e3 = $e1; // assigna la referència de '$e1' a '$e3, no el contingut
    
    echo $e1->__toString() . "<br>";  // mostra el contingut de '$e1'
    echo $e2->__toString() . "<br>";  // mostra el contingut de '$e2'
    echo $e3->__toString() . "<br>";  // mostra el contingut de '$e1' o '$e3'
    if ($e1 === $e2) echo "e1===e2" . "<br>";  // compara referències  
    if ($e1 === $e3) echo "e1===e3" . "<br>";  // compara referències 
    if ($e1->equals($e2)) echo "e1 equals e2" . "<br>";  // compara continguts si 'equals' està definit
    if ($e1->equals($e3)) echo "e1 equals e3";  // compara continguts si 'equals' està definit
?>
