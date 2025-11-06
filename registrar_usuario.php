<?php
require_once __DIR__ . '/conexion.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nombre = $_POST['nombreUsuario'];
  $correo = $_POST['correoUsuario'];
  $password = password_hash($_POST['claveUsuario'], PASSWORD_DEFAULT);

  $sql = "INSERT INTO usuarios (nombre, correo, password) VALUES (?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sss", $nombre, $correo, $password);

  if ($stmt->execute()) {
    echo "<script>
    alert('usuario creado exitosamente');
    </script>";
      header("location: index.php?registro=exitoso");
  } else {
    echo "Error al registrar: " . $stmt->error;
  }

  $stmt->close();
  $conn->close();
}
?>
