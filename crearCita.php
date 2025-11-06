<?php include('conexion.php'); ?>

<form method="POST" action="">
    <input type="text" name="nombre_mascota" placeholder="Nombre de la mascota" required><br>
    <input type="text" name="nombre_dueno" placeholder="Nombre del dueño" required><br>
    <input type="date" name="fecha_cita" required><br>
    <input type="time" name="hora_cita" required><br>
    <textarea name="motivo" placeholder="Motivo de la cita"></textarea><br>
    <button type="submit" name="guardar">Guardar cita</button>
</form>

<?php
if (isset($_POST['guardar'])) {
    $nombre_mascota = $_POST['nombre_mascota'];
    $nombre_dueno = $_POST['nombre_dueno'];
    $fecha = $_POST['fecha_cita'];
    $hora = $_POST['hora_cita'];
    $motivo = $_POST['motivo'];

    $sql = "INSERT INTO citas_medicas (nombre_mascota, nombre_dueno, fecha_cita, hora_cita, motivo)
            VALUES ('$nombre_mascota', '$nombre_dueno', '$fecha', '$hora', '$motivo')";

    if ($conn->query($sql) === TRUE) {
        echo "✅ Cita registrada correctamente";
    } else {
        echo "❌ Error: " . $conn->error;
    }
}
?>
