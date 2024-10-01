<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
    </head>
    <body>
        <h2>Iniciar Sesión</h2>
        <form action="authenticate.php" method="POST">
            <label for="username">Nombre de Usuario:</label>
            <input type="text" id="username" name="username" required><br><br>
            
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required><br><br>
            
            <input type="submit" value="Iniciar Sesión">
        </form>
    </body>
</html>
