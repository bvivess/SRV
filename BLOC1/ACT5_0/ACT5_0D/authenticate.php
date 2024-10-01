<?php
    session_start(); // Inicia la sesión

    // Array d'usuaris
    $users = [ 'user1' => 'password1',
               'user2' => 'password2',
             ];

    // Recollida de variables
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Comprovació de l''username' i 'password'
    if (isset($users[$username]) && $users[$username] === $password) {
        // Credencials correctes
        $_SESSION['username'] = $username;
        header("Location: protected.php"); // Redirecció a una pàgina protegida: 'protected.php'
        exit();
    } else {
        // Credencials incorrectes
        echo "Nombre de usuario o contraseña incorrectos.";
    }
?>
