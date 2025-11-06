<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nombre_propietario = $_POST['nombrePropietario'];
  $email = $_POST['email'];
  $telefono = $_POST['telefono'];
  $nombre_mascota = $_POST['nombreMascota'];
  $tipo_mascota = $_POST['tipoMascota'];
  $motivo = $_POST['motivo'];
  $fecha = $_POST['fecha'];

  $sql = "INSERT INTO citas_medicas (nombre_propietario, email, telefono, nombre_mascota, tipo_mascota, motivo, fecha)
          VALUES (?, ?, ?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sssssss", $nombre_propietario, $email, $telefono, $nombre_mascota, $tipo_mascota, $motivo, $fecha);

  if ($stmt->execute()) {
    // Mostrar mensaje de confirmación
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
      <meta charset="UTF-8">
      <title>Cita registrada</title>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body>
      <script>
        Swal.fire({
          icon: 'success',
          title: '¡Cita registrada con éxito!',
          html: `
            <p>Gracias <strong><?php echo htmlspecialchars($nombre_propietario); ?></strong> 🐾</p>
            <p>Tu cita para <strong><?php echo htmlspecialchars($nombre_mascota); ?></strong> ha sido agendada correctamente.</p>
            <p><b>Motivo:</b> <?php echo htmlspecialchars($motivo); ?></p>
            <p><b>Fecha:</b> <?php echo htmlspecialchars($fecha); ?></p>
          `,
          confirmButtonColor: '#48C78E',
          confirmButtonText: 'Volver al inicio'
        }).then(() => {
          window.location.href = 'index.php';
        });
      </script>
    </body>
    </html>
    <?php
  } else {
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
      <meta charset="UTF-8">
      <title>Error al registrar</title>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body>
      <script>
        Swal.fire({
          icon: 'error',
          title: 'Error al registrar la cita',
          text: 'Ocurrió un problema. Por favor, intenta nuevamente.',
          confirmButtonColor: '#E74C3C',
          confirmButtonText: 'Volver'
        }).then(() => {
          window.location.href = 'index.php';
        });
      </script>
    </body>
    </html>
    <?php
  }

  $stmt->close();
  $conn->close();
}
?>
