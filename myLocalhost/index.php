<?php
    // Inicia una sesión
    session_start();
    $ole= 'Session_id: ' . session_id(); // Muestra el ID de sesión actual
    
    // Destruir la sesión actual
    session_unset(); // Elimina todas las variables de sesión
    session_destroy(); // Destruye la sesión
    
    // Inicia una nueva sesión
    session_start();
    
    // Muestra el nuevo session_id
    echo $ole . ' Nuevo session_id: ' . session_id();
?>