<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
</head>
<body>
    <h1>Crear una nueva cuenta</h1>

    <?php if (isset($error)): ?>
        <p style="color:red;"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST" action="index.php?accion=alta">
        Email:<br>
        <input type="email" name="email" required><br><br>

        Contraseña:<br>
        <input type="password" name="password" required minlength="4"><br><br>

        <button type="submit">Registrarse</button>
    </form>

    <br>
    <p>¿Ya tienes una cuenta? <a href="index.php?accion=login">Inicia sesión aquí</a></p>
    <a href="index.php">Volver al inicio</a>
</body>
</html>