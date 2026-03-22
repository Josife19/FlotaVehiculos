<html>
<body>
<h1>Flota de Vehículos</h1>
<a href="index.php?accion=agregar">Agregar Vehículo</a>
<table border="1">
<tr><th>ID</th><th>Marca</th><th>Modelo</th><th>Precio</th><th>Acciones</th></tr>
<?php foreach ($vehiculos as $v): ?>
<tr>
<td><?= $v->getId() ?></td>
<td><?= $v->getMarca() ?></td>
<td><?= $v->getModelo() ?></td>
<td><?= $v->getPrecioDia() ?></td>
<td><a href="index.php?accion=eliminar&id=<?= $v->getId() ?>">Eliminar</a></td>
</tr>
<?php endforeach; ?>
</table>
</body>
</html>
