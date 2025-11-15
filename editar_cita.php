<?php
include 'conexion.php';

if (
    isset($_GET['id']) &&
    isset($_GET['nombre_propietario']) &&
    isset($_GET['nombre_mascota']) &&
    isset($_GET['motivo']) &&
    isset($_GET['fecha'])
) {
    $id = $_GET['id'];
    $nombre_propietario = $_GET['nombre_propietario'];
    $nombre_mascota = $_GET['nombre_mascota'];
    $motivo = $_GET['motivo'];
    $fecha = $_GET['fecha'];

    $stmt = $conn->prepare("UPDATE citas_medicas SET nombre_propietario=?, nombre_mascota=?, motivo=?, fecha=? WHERE id=?");
    $stmt->bind_param("ssssi", $nombre_propietario, $nombre_mascota, $motivo, $fecha, $id);

    if ($stmt->execute()) {
        echo "<script>
            alert(' Cita actualizada correctamente');
            window.location.href = 'panel_admin.php';
        </script>";
    } else {
        echo "<script>
            alert('Error al actualizar la cita');
            window.location.href = 'panel_admin.php';
        </script>";
    }
}
?>
