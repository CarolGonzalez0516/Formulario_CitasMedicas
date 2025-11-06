<?php
include('conexion.php');
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM citas_medicas WHERE id=$id");
$fila = $result->fetch_assoc();
?>

<form method="POST" action="">
    <input type="text" name="nombre_mascota" value="<?= $fila['nombre_mascota'] ?>" required><br>
    <input type="text" name="nombre_dueno" value="<?= $fila['nombre_dueno'] ?>" required><br>
    <input type="date" name="fecha_cita" value="<?= $fila['fecha_cita'] ?>" required><br>
    <input type="time" name="hora_cita" value="<?= $fila['hora_cita'] ?>" required><br>
    <textarea name="motivo"><?= $fila['motivo'] ?></textarea><br>
    <button type="submit" name="actualizar">Actualizar</button>
</form>

<?php
if (isset($_POST['actualizar'])) {
    $nombre_mascota = $_POST['nombre_mascota'];
    $nombre_dueno = $_POST['nombre_dueno'];
    $fecha = $_POST['fecha_cita'];
    $hora = $_POST['hora_cita'];
    $motivo = $_POST['motivo'];

    $sql = "UPDATE citas_medicas 
            SET nombre_mascota='$nombre_mascota', nombre_dueno='$nombre_dueno', fecha_cita='$fecha', hora_cita='$hora', motivo='$motivo' 
            WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "✅ Registro actualizado correctamente";
        header("Location: listar.php");
    } else {
        echo "❌ Error: " . $conn->error;
    }
}
?>
