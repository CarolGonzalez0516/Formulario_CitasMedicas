<?php
include 'conexion.php'; // Asegúrate de que este archivo esté en la misma carpeta

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Asegura que sea un número entero

    // Preparar y ejecutar la eliminación
    $query = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
    $query->bind_param("i", $id);

    if ($query->execute()) {
         echo "<script>
            alert('Usuario eliminado correctamente');
            window.location.href = 'panel_admin.php';
        </script>";
        // Redirigir si se elimina correctamente
        //header("Location: panel_admin.php?mensaje=eliminado");
        //exit();
    } else {
        echo "Error al eliminar el usuario: " . $conn->error;
    }

    $query->close();
} else {
    echo "ID no recibido.";
}

$conn->close();
?>
