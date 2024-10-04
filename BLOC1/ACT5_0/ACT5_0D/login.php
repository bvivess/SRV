<?php
    session_start(); // associa la sessió a l'actual

    // Array d'usuaris possibles
    $users = [ 'user1' => 'password1',
               'user2' => 'password2',
             ];

    // Recollida de variables
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Comprovació de l''username' i 'password'
    if (isset($users[$username]) && $users[$username] === $password) {
        $_SESSION['username'] = $username;  // Inclou dades de l'usuari a '$_SESSION'
        header("Location: intranet.php");  // redirecció a 'intranet.php'
        exit();  // garanteix que no s'executi més codi
    } else {
        // Credencials incorrectes
        echo "Credencials incorrectes.";
    }
?>
