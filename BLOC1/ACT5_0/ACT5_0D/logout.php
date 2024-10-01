<?php
    session_start(); // Inicia la sesión
    session_destroy(); // Destruye la sesión actual
    header("Location: index.php"); // Redirige al usuario al formulario de login
    exit();
?>
