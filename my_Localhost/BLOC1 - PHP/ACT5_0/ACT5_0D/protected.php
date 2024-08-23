<?php
    session_start(); // Inicia la sessió
    echo "ID: " . session_id() . "<br>";
    // Comprova si l'usuari ha iniciat la sessió
    if (!isset($_SESSION['username'])) {
        // Si no es troba una sessió, cal treure l'usuari fora
        header("Location: login.php");
        exit();
    }
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Pàgina Protegida</title>
    </head>
    <body>
        <h2>Benvingut, <?php echo htmlspecialchars($_SESSION['username']); ?>!!!</h2>
        <p>Això és una pàgina protegida.</p>
        <a href="logout.php">Tancar Sesión</a>
    </body>
</html>
