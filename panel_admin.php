<?php
session_start();
include 'conexion.php';

// Verificar si el admin inició sesión
if (!isset($_SESSION['admin'])) {
  header("Location: login_admin.php");
  exit();
}

// Cerrar sesión
if (isset($_GET['logout'])) {
  session_destroy();
  header("Location: login_admin.php");
  exit();
}

// Consultar usuarios y citas
$usuarios = $conn->query("SELECT * FROM usuarios");
$citas = $conn->query("SELECT * FROM citas_medicas");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel de Administración</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    body { background-color: #f8f9fa; padding: 40px; }
    .container { background: #fff; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); padding: 30px; }
    table th { background-color: #48C78E; color: white; text-align: center; }
    td, th { vertical-align: middle; text-align: center; }
    .btn { border-radius: 20px; }
    .top-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="top-bar">
      <a href="?logout=true" class="btn btn-danger btn-sm">Cerrar sesión</a>
    </div>

    <ul class="nav nav-tabs" id="adminTabs" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="usuarios-tab" data-bs-toggle="tab" data-bs-target="#usuarios" type="button" role="tab">Usuarios</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="citas-tab" data-bs-toggle="tab" data-bs-target="#citas" type="button" role="tab">Citas Médicas</button>
      </li>
    </ul>

    <div class="tab-content mt-4" id="adminTabsContent">

      <!-- Usuarios -->
      <div class="tab-pane fade show active" id="usuarios" role="tabpanel">
        <table class="table table-bordered table-hover align-middle">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Correo</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($usuarios && $usuarios->num_rows > 0) {
              $contador = 1;
              while ($row = $usuarios->fetch_assoc()) {
                $nombre = $row['nombre'] ?? '';
                $correo = $row['correo'] ?? '';
                $id = $row['id'] ?? '';
                echo "<tr>
                        <td>{$contador}</td>
                        <td>" . htmlspecialchars($nombre) . "</td>
                        <td>" . htmlspecialchars($correo) . "</td>
                        <td>
                          <button class='btn btn-warning btn-sm' onclick=\"editarUsuario('{$nombre}', '{$correo}')\">Editar</button>
                          <button class='btn btn-danger btn-sm' onclick=\"eliminarRegistro('eliminar_usuario.php', '{$id}')\">Eliminar</button>
                        </td>
                      </tr>";
                $contador++;
              }
            } else {
              echo "<tr><td colspan='4'>No hay usuarios registrados.</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>

      <!-- Citas -->
      <div class="tab-pane fade" id="citas" role="tabpanel">
        <table class="table table-bordered table-hover align-middle">
          <thead>
            <tr>
              <th>ID</th>
              <th>Propietario</th>
              <th>Mascota</th>
              <th>Motivo</th>
              <th>Fecha</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($citas && $citas->num_rows > 0) {
              $contador = 1;
              while ($row = $citas->fetch_assoc()) {
                echo "<tr>
                        <td>{$contador}</td>
                        <td>" . htmlspecialchars($row['nombre_propietario']) . "</td>
                        <td>" . htmlspecialchars($row['nombre_mascota']) . "</td>
                        <td>" . htmlspecialchars($row['motivo']) . "</td>
                        <td>" . htmlspecialchars($row['fecha']) . "</td>
                        <td>
                          <button class='btn btn-warning btn-sm' onclick=\"editarCita('{$row['id']}', '{$row['nombre_propietario']}', '{$row['nombre_mascota']}', '{$row['motivo']}', '{$row['fecha']}')\">Editar</button>
                          <button class='btn btn-danger btn-sm' onclick=\"eliminarRegistro('eliminar_cita.php', '{$row['id']}')\">Eliminar</button>
                        </td>
                      </tr>";
                $contador++;
              }
            } else {
              echo "<tr><td colspan='6'>No hay citas registradas.</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    function eliminarRegistro(archivo, id) {
      Swal.fire({
        title: '¿Eliminar registro?',
        text: 'Esta acción no se puede deshacer.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminar'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = archivo + '?id=' + id;
        }
      });
    }

    function editarUsuario(nombre, correo) {
      Swal.fire({
        title: 'Editar Usuario',
        html:
          '<input id="swal-nombre" class="swal2-input" value="' + nombre + '">' +
          '<input id="swal-correo" class="swal2-input" value="' + correo + '">',
        focusConfirm: false,
        preConfirm: () => {
          const nuevoNombre = document.getElementById('swal-nombre').value;
          const nuevoCorreo = document.getElementById('swal-correo').value;
          if (!nuevoNombre || !nuevoCorreo) {
            Swal.showValidationMessage('Por favor completa ambos campos');
            return false;
          }
          window.location.href = 'editar_usuario.php?correo=' + correo + '&nuevo_nombre=' + nuevoNombre + '&nuevo_correo=' + nuevoCorreo;
        }
      });
    }

    function editarCita(id, propietario, mascota, motivo, fecha) {
      Swal.fire({
        title: 'Editar Cita',
        html:
          '<input id="swal-prop" class="swal2-input" value="' + propietario + '">' +
          '<input id="swal-masc" class="swal2-input" value="' + mascota + '">' +
          '<input id="swal-mot" class="swal2-input" value="' + motivo + '">' +
          '<input id="swal-fecha" type="date" class="swal2-input" value="' + fecha + '">',
        focusConfirm: false,
        preConfirm: () => {
          const prop = document.getElementById('swal-prop').value;
          const masc = document.getElementById('swal-masc').value;
          const mot = document.getElementById('swal-mot').value;
          const f = document.getElementById('swal-fecha').value;
          if (!prop || !masc || !mot || !f) {
            Swal.showValidationMessage('Por favor completa todos los campos');
            return false;
          }
          window.location.href = 'editar_cita.php?id=' + id + '&nombre_propietario=' + prop + '&nombre_mascota=' + masc + '&motivo=' + mot + '&fecha=' + f;
        }
      });
    }
  </script>
</body>
</html>
