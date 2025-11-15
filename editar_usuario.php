<?php
include 'conexion.php';

if (isset($_GET['correo']) && isset($_GET['nuevo_nombre']) && isset($_GET['nuevo_correo'])) {
    $correo = $_GET['correo'];
    $nuevo_nombre = $_GET['nuevo_nombre'];
    $nuevo_correo = $_GET['nuevo_correo'];

    $stmt = $conn->prepare("UPDATE usuarios SET nombre=?, correo=? WHERE correo=?");
    $stmt->bind_param("sss", $nuevo_nombre, $nuevo_correo, $correo);

    if ($stmt->execute()) {
        echo "<script>
            alert('✅ Usuario actualizado correctamente');
            window.location.href = 'panel_admin.php';
        </script>";
    } else {
        echo "<script>
            alert('❌ Error al actualizar el usuario');
            window.location.href = 'panel_admin.php';
        </script>";
    }
}
?>
