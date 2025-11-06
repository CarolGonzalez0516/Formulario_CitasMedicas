<?php
include('conexion.php');
$result = $conn->query("SELECT * FROM citas_medicas");
?>

<h2>Listado de Citas Médicas</h2>
<table border="1" cellpadding="8">
<tr>
    <th>ID</th>
    <th>Mascota</th>
    <th>Dueño</th>
    <th>Fecha</th>
    <th>Hora</th>
    <th>Motivo</th>
    <th>Acciones</th>
</tr>

<?php while ($fila = $result->fetch_assoc()) { ?>
<tr>
    <td><?= $fila['id'] ?></td>
    <td><?= $fila['nombre_mascota'] ?></td>
    <td><?= $fila['nombre_dueno'] ?></td>
    <td><?= $fila['fecha_cita'] ?></td>
    <td><?= $fila['hora_cita'] ?></td>
    <td><?= $fila['motivo'] ?></td>
    <td>
        <a href="editar.php?id=<?= $fila['id'] ?>">Editar</a> |
        <a href="eliminar.php?id=<?= $fila['id'] ?>">Eliminar</a>
    </td>
</tr>
<?php } ?>
</table>
