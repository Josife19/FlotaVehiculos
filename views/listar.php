<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Flota de Vehículos</title>
</head>
<body>
    <h1>Flota de Vehículos</h1>

    <?php if (isset($_SESSION['usuario_id'])): ?>
        <p>
            Sesión iniciada como: <?= htmlspecialchars($_SESSION['usuarioEmail']) ?> |
            <a href="index.php?accion=logout">Cerrar sesión</a>
        </p>
    <?php else: ?>
        <p>
            <a href="index.php?accion=login">Iniciar sesión</a> |
            <a href="index.php?accion=alta">Registrarse</a>
        </p>
    <?php endif; ?>

    <a href="index.php?accion=agregar">Agregar Vehículo</a>

    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>

        <?php foreach ($vehiculos as $v): ?>
            <tr>
                <td><?= $v->getId() ?></td>
                <td><?= htmlspecialchars($v->getMarca()) ?></td>
                <td><?= htmlspecialchars($v->getModelo()) ?></td>
                <td><?= $v->getPrecioDia() ?></td>
                <td>
                    <a href="index.php?accion=eliminar&id=<?= $v->getId() ?>"
                       onclick="return confirm('¿Seguro que quieres eliminar este vehículo?')">
                        Eliminar
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>