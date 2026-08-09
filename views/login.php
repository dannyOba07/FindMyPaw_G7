<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FindMyPaw</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="../js/auth.js"></script>
</head>
<body class="container mt-5">

  <h1>Bienvenido a FindMyPaw!</h1>
  <h2>Iniciar Sesión</h2>

  <div class="alert alert-danger d-none" id="loginError"></div>

  <form id="formLogin">
    <input
      type="email"
      class="form-control mb-2"
      name="correo"
      id="correoLogin"
      placeholder="Ingresa tu Correo">

    <input
      type="password"
      class="form-control mb-2"
      name="password"
      id="passwordLogin"
      placeholder="Ingresa tu Contraseña">

    <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
    <a href="register.php" class="btn btn-secondary ms-2">Registrarse</a>
  </form>

</body>
</html>