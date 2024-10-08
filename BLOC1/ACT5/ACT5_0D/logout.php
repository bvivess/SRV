<?php
    session_start();  // associa la sessió a l'actual
    session_destroy(); // Elimina la sessió
    header("Location: index.php");  // redirigeix a 'index'
    exit();
?>
