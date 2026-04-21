<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Vehículo</title>
</head>
<body>
    <h1>Agregar Vehículo</h1>

    <?php if (isset($error)): ?>
        <p style="color:red;"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST" action="index.php?accion=agregar">
        Marca: <input type="text" name="marca" required><br><br>
        Modelo: <input type="text" name="modelo" required><br><br>
        Precio: <input type="number" name="precioDia" step="0.01" required><br><br>
        <button type="submit">Guardar</button>
    </form>

    <br>
    <a href="index.php">Volver</a>
</body>
</html>