<?php
    session_start(); // associa la sessió a l'actual
    ob_start();  // necessari per a la redirecció de 'header()': resetea el buffer de sortida

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

    ob_end_flush();  // necessari per a la redirecció de 'header()': envia la sortida enmagatzemada en el buffer
?>
