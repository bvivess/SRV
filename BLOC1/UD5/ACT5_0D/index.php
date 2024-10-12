<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
    </head>
    <body>
        <h2>Iniciar Sessió</h2>
        <form action="login.php" method="POST">
            <label for="username">Usuari:</label>
            <input type="text" id="username" name="username" required><br><br>
            
            <label for="password">Contrasenya:</label>
            <input type="password" id="password" name="password" required><br><br>
            
            <input type="submit" value="Iniciar Sessió">
        </form>
    </body>
</html>
