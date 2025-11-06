<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Veterinaria - Inicio</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script>
     window.onload = function() {
      const params = new URLSearchParams(window.location.search);
      if (params.get('registro') === 'exitoso') {
        alert('Usuario registrado exitosamente');
      }
    }
  </script>
  <style>
    body {
      background-image: url('imagenes/imagen5.jpg');
      background-size: cover;
      background-repeat: no-repeat;
      background-position: left;
      background-attachment: fixed;
      font-family: Arial, sans-serif;
    }

    .overlay {
      background-color: rgba(255, 255, 255, 0.9);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .container {
      max-width: 380px;
      margin: 80px auto;
      background: white;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0,0,0,0.2);
      animation: fadeIn 0.6s ease;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    h2 {
      text-align: center;
      color: #050505;
      margin-bottom: 10px;
    }

    p.subtext {
      text-align: center;
      color: #555;
      margin-bottom: 20px;
    }

    .form-group {
      margin-bottom: 12px;
    }

    label {
      display: block;
      margin-bottom: 5px;
      color: #555;
      font-size: 14px;
    }

    input, select {
      width: 92%;
      padding: 7px 8px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 14px;
    }

    .btn {
      background-color: #67bed9;
      color: white;
      padding: 8px 0;
      border: none;
      border-radius: 5px;
      width: 50%;
      font-size: 14px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      margin-top: 10px;
      margin-left: 90px;
    }

    .btn:hover {
      background-color: #56abc4;
    }

    .footer-link {
      text-align: center;
      margin-top: 15px;
      font-size: 13px;
    }

    .footer-link a {
      color: #67bed9;
      text-decoration: underline;
      cursor: pointer;
    }

    .footer-link a:hover {
      color: #56abc4;
    }

    #registroForm, #formularioCita, #confirmacionCita, #confirmacionRegistro {
      display: none;
    }

    .whatsapp-container {
      position: fixed;
      bottom: 25px;
      right: 25px;
      display: flex;
      align-items: center;
      z-index: 100;
      gap: 10px;
    }

    .whatsapp-message {
      background-color: #ffffff;
      color: #333;
      font-size: 14px;
      padding: 10px 14px;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.2);
      white-space: nowrap;
      transition: opacity 0.3s ease;
      border-left: 4px solid #25d366;
    }

    .whatsapp-float {
      width: 55px;
      height: 55px;
      background-color: #25d366;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 3px 8px rgba(0,0,0,0.3);
      transition: all 0.3s ease;
    }

    .whatsapp-float:hover {
      background-color: #1ebe5d;
      transform: scale(1.1);
      box-shadow: 0 4px 10px rgba(0,0,0,0.4);
    }

    .whatsapp-float img {
      width: 30px;
      height: 30px;
    }

    /* Estilos del modal admin */
    .modal {
      display: none;
      position: fixed;
      z-index: 200;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow-y: auto;
      background-color: rgba(0,0,0,0.6);
    }

    .modal-content {
      background-color: #fff;
      margin: 5% auto;
      padding: 20px;
      border-radius: 10px;
      width: 90%;
      max-width: 900px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #67bed9;
      color: white;
    }

    .close-btn {
      float: right;
      color: #333;
      font-size: 18px;
      cursor: pointer;
    }

    .admin-btn {
      position: fixed;
      top: 15px;
      right: 15px;
      background-color: #67bed9;
      color: white;
      padding: 8px 12px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }
  </style>
</head>
<body>

  <button class="admin-btn" onclick="abrirAdmin()">Panel Admin</button>

  <!-- Login principal -->
  <div class="container" id="inicioSesion">
    <h2>¡Haciendo felices a tus mascotas!</h2>
    <p class="subtext">Inicia sesión en tu cuenta para agendar tu cita</p>
    <form onsubmit="return iniciarSesion(event)">
      <div class="form-group">
        <label for="correoLogin">Correo electrónico</label>
        <input type="email" id="correoLogin" required>
      </div>
      <div class="form-group">
        <label for="claveLogin">Contraseña</label>
        <input type="password" id="claveLogin" required>
      </div>
      <button type="submit" class="btn">Ingresar</button>
    </form>
    <div class="footer-link">
      <p>¿Eres nuevo en la clínica? <a href="#" onclick="mostrarRegistro()">Crea una cuenta</a></p>
    </div>
  </div>

  <!-- Formulario de registro -->
  <form action="registrar_usuario.php" method="POST">
    <div class="container" id="registroForm">
      <h2>Crear cuenta</h2>
      <div class="form-group">
        <label for="nombreUsuario">Nombre completo</label>
        <input type="text" id="nombreUsuario" name="nombreUsuario" required>
      </div>
      <div class="form-group">
        <label for="correoUsuario">Correo electrónico</label>
        <input type="email" id="correoUsuario" name="correoUsuario" required>
      </div>
      <div class="form-group">
        <label for="claveUsuario">Contraseña</label>
        <input type="password" id="claveUsuario" name="claveUsuario" required>
      </div>
      <button type="submit" class="btn">Registrarse</button>
    </div>
  </form>

  <!-- Pantalla de confirmación de registro -->
  <div class="container" id="confirmacionRegistro">
    <h2>✅ Su cuenta ha sido creada con éxito</h2>
    <p class="subtext">¡Bienvenido! Ahora puedes ingresar con tu correo y contraseña.</p>
    <button class="btn" onclick="volverAlInicioDesdeRegistro()">Ingresar</button>
  </div>

  <!-- Formulario de cita -->
  <form action="registrar_cita.php" method="POST">
  <div class="container" id="formularioCita">
    <h2>Agenda tu cita médica</h2>
      <div class="form-group">
        <label for="nombrePropietario">Nombre del propietario *</label>
        <input type="text" id="nombrePropietario" name="nombrePropietario" required>
      </div>
      <div class="form-group">
        <label for="email">Correo electrónico *</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="telefono">Número de teléfono</label>
        <input type="tel" id="telefono" name="telefono">
      </div>
      <div class="form-group">
        <label for="nombreMascota">Nombre de la mascota *</label>
        <input type="text" id="nombreMascota" name="nombreMascota" required>
      </div>
      <div class="form-group">
        <label for="tipoMascota">Tipo de mascota *</label>
        <select id="tipoMascota" name="tipoMascota" required>
          <option value="">Selecciona una opción</option>
          <option value="Perro">Perro</option>
          <option value="Gato">Gato</option>
          <option value="Otro">Otro</option>
        </select>
      </div>
      <div class="form-group">
        <label for="motivo">Motivo de la visita *</label>
        <select id="motivo" name="motivo" required>
          <option value="">Selecciona una opción</option>
          <option value="Consulta general">Consulta general</option>
          <option value="Vacunación">Vacunación</option>
          <option value="Exámenes Médicos">Exámenes Médicos</option>
        </select>
      </div>
      <div class="form-group">
        <label for="fecha">Fecha preferida *</label>
        <input type="date" id="fecha" name="fecha" required>
      </div>
      <button type="submit" class="btn">Solicitar cita ➔</button>
  </div>
  </form>

  <!-- Pantalla de confirmación -->
  <div class="container" id="confirmacionCita">
    <h2>¡Tu cita ha sido agendada con éxito!</h2>
    <p class="subtext">Te contactaremos pronto para confirmar los detalles.</p>
    <button class="btn" onclick="volverInicio()">Volver al inicio</button>
  </div>

  <!-- Modal Admin -->
  <div id="modalAdmin" class="modal">
    <div class="modal-content">
      <span class="close-btn" onclick="cerrarAdmin()">&times;</span>
      <h2>Panel de Administración</h2>
      <iframe src="panel_admin.php" style="width:100%;height:500px;border:none;"></iframe>
    </div>
  </div>

  <div class="whatsapp-container">
    <div class="whatsapp-message">¡Hola! ¿En qué podemos ayudarte?</div>
    <a href="https://wa.me/573054802322?text=¿Necesitas agendar una consulta veterinaria en nuestra clínica para tu mascota ó tienes alguna pregunta?"
       class="whatsapp-float" target="_blank" title="Chatea con nosotros por WhatsApp">
      <img src="https://cdn-icons-png.flaticon.com/512/124/124034.png" alt="WhatsApp">
    </a>
  </div>

  <script>
    function iniciarSesion(event) {
      event.preventDefault();
      document.getElementById("inicioSesion").style.display = "none";
      document.getElementById("formularioCita").style.display = "block";
      return false;
    }

    function mostrarRegistro() {
      document.getElementById("inicioSesion").style.display = "none";
      document.getElementById("registroForm").style.display = "block";
    }

    function volverAlInicioDesdeRegistro() {
      document.getElementById("confirmacionRegistro").style.display = "none";
      document.getElementById("inicioSesion").style.display = "block";
    }

    function volverInicio() {
      document.getElementById("confirmacionCita").style.display = "none";
      document.getElementById("inicioSesion").style.display = "block";
    }

    function abrirAdmin() {
      document.getElementById("modalAdmin").style.display = "block";
    }

    function cerrarAdmin() {
      document.getElementById("modalAdmin").style.display = "none";
    }

    (function inicializar() {
      document.getElementById("inicioSesion").style.display = "block";
      document.getElementById("registroForm").style.display = "none";
      document.getElementById("formularioCita").style.display = "none";
      document.getElementById("confirmacionCita").style.display = "none";
      document.getElementById("confirmacionRegistro").style.display = "none";
    })();
  </script>
</body>
</html>
