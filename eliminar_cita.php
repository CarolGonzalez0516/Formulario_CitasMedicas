<?php
include 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM citas_medicas WHERE id=?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>
            alert('Cita eliminada correctamente');
            window.location.href = 'panel_admin.php';
        </script>";
    } else {
        echo "<script>
            alert('Error al eliminar la cita');
            window.location.href = 'panel_admin.php';
        </script>";
    }
}
?>
