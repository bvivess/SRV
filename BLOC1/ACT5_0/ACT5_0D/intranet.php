<?php
    session_start(); // si ja existeix sessió, associa la sessió a l'actual
    
    // Comprova si l'usuari ha iniciat la sessió
    if (!isset($_SESSION['username'])) {  // si està definida amb un valor no null -> true
        // Si no es troba una sessió, cal treure l'usuari fora
        header("Location: login.php");  // redirigeix a 'login'
        exit();  // garanteix que no s'executi més codi
    }
?>

<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Pàgina Protegida</title>
    </head>
    <body>
        <h2>Benvingut, <?php echo htmlspecialchars($_SESSION['username']); ?>!!!</h2>
        <p>Això és una pàgina protegida.</p>
		<p><?php echo "ID: " . session_id() . "<br>"; ?></p>
        <a href="logout.php">Tancar Sessió</a>
    </body>
</html>
