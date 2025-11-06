<?php
include('conexion.php');
$id = $_GET['id'];

$sql = "DELETE FROM citas_medicas WHERE id=$id";
if ($conn->query($sql) === TRUE) {
    echo "✅ Registro eliminado correctamente";
    header("Location: listar.php");
} else {
    echo "❌ Error: " . $conn->error;
}
?>
