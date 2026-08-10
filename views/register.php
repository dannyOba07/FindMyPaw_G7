<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>FindMyPaw - Registro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="../js/auth.js"></script>
  <script src="../views/login.php"></script>

</head>
<body class="container mt-5"> 

  <h2>Registro</h2>

  <div class="alert alert-danger d-none" id="registerError"></div>
  <div class="alert alert-success d-none" id="registerSuccess"></div>

  <form id="formRegister">
    <input
      class="form-control mb-2"
      name="nombre"
      id="regNombre"
      placeholder="Nombre">

    <input
      class="form-control mb-2"
      name="apellido_paterno"
      id="regApellidoPaterno"
      placeholder="Apellido paterno">

    <input
      class="form-control mb-2"
      name="apellido_materno"
      id="regApellidoMaterno"
      placeholder="Apellido materno">

    <input
      type="email"
      class="form-control mb-2"
      name="correo"
      id="regCorreo"
      placeholder="Correo">

    <input
      class="form-control mb-2"
      name="telefono"
      id="regTelefono"
      placeholder="Teléfono">

    <input
      class="form-control mb-2"
      name="direccion"
      id="regDireccion"
      placeholder="Dirección">

    <input
      type="password"
      class="form-control mb-2"
      name="password"
      id="regPassword"
      placeholder="Contraseña">

    <select class="form-select mb-3" id="regRol" name="id_rol">
      <option value="1">Usuario General</option>
      <option value="2">Rescatista/Refugio</option>
    </select>

    <button type="submit" class="btn btn-success">
      Registrarse
    </button>
    <a href="login.php" class="btn btn-secondary ms-2">Volver al Login</a>
  </form>

</body>
</html>