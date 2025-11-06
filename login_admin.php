<?php
session_start();
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $usuario = $_POST['usuario'];
  $contrasena = $_POST['contrasena'];

  $stmt = $conn->prepare("SELECT * FROM admin WHERE usuario=? AND contrasena=SHA2(?, 256)");
  $stmt->bind_param("ss", $usuario, $contrasena);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $_SESSION['admin'] = $usuario;
    echo "<script>
      localStorage.setItem('adminLogin', 'success');
      window.location.href = 'panel_admin.php';
    </script>";
    exit();
  } else {
    echo "<script>
      localStorage.setItem('adminLogin', 'error');
      window.location.href = 'login_admin.php';
    </script>";
  }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Login Administrador</title>
  <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet'>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    body {
      background: linear-gradient(120deg, #56abc4, #67bed9);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: 'Arial', sans-serif;
    }
    .login-card {
      background: white;
      border-radius: 15px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.2);
      padding: 30px;
      width: 350px;
      animation: fadeIn 0.6s ease-in-out;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    h4 {
      color: #333;
      font-weight: 600;
    }
    .btn-primary {
      background-color: #67bed9;
      border: none;
    }
    .btn-primary:hover {
      background-color: #56abc4;
    }
    .btn-warning{
      --bs-btn-color: #000;
      --bs-btn-bg: #67bed9;
      --bs-btn-border-color: #67bed9;
      --bs-btn-hover-color: #000;
      --bs-btn-hover-bg: #67bed9;67bed9
      --bs-btn-hover-border-color: #67bed9;
      --bs-btn-focus-shadow-rgb: 217, 164, 6;
      --bs-btn-active-color: #000;
      --bs-btn-active-bg: #67bed9;
      --bs-btn-active-border-color: #67bed9;
      --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
      --bs-btn-disabled-color: #000;
      --bs-btn-disabled-bg: #67bed9;
      --bs-btn-disabled-border-color: #67bed9;
    }
    .volver {
      margin-top: 15px;
      display: block;
      text-align: center;
      font-size: 14px;
      color: #56abc4;
      text-decoration: none;
    }
    .volver:hover {
      text-decoration: underline;
      color: #3e93a7;
    }
  </style>
</head>
<body>
  <div class="login-card text-center">
    <h4 class="mb-3">🔒 Panel de Administración</h4>
    <form method="POST" action="">


      <div class="mb-3 text-start">
        <label class="form-label">Usuario</label>
        <input type="text" name="usuario" class="form-control" required>
      </div>
      <div class="mb-3 text-start">
        <label class="form-label">Contraseña</label>
        <input type="password" name="contrasena" class="form-control" required>
      </div>
      <button class="btn btn-primary w-100">Ingresar</button>
    </form>
    <a href="index.php" class="volver">⬅️ Volver al inicio</a>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const status = localStorage.getItem('adminLogin');
      if (status === 'success') {
        Swal.fire({
          icon: 'success',
          title: 'Bienvenido',
          text: 'Inicio de sesión exitoso.',
          showConfirmButton: false,
          timer: 1500
        });
      } else if (status === 'error') {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Usuario o contraseña incorrectos.',
          confirmButtonText: 'Intentar nuevamente'
        });
      }
      localStorage.removeItem('adminLogin');
    });
  </script>
</body>
</html>
