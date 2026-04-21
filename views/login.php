<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio de sesión</title>
</head>
<body>
    <h1>Iniciar sesión</h1>

    <?php if (isset($error)): ?>
        <p style="color:red;"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST" action="index.php?accion=login">
        Email:<br>
        <input type="email" name="email" required><br><br>

        Contraseña:<br>
        <input type="password" name="password" required><br><br>

        <input type="checkbox" name="recordarme" id="recordarme">
        <label for="recordarme">Recordarme</label><br><br>

        <button type="submit">Entrar</button>
    </form>

    <br>
    <p>¿No tienes cuenta? <a href="index.php?accion=alta">Regístrate aquí</a></p>
    <a href="index.php">Volver al inicio</a>
</body>
</html>