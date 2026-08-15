<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FindMyPaw - Iniciar Sesión</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

    <div class="login-container">
        <h1>Bienvenido a FindMyPaw !</h1>
        <h2>Iniciar Sesión</h2>

        <!-- Mensaje de error de jQuery -->
        <div id="loginError" class="d-none" style="color: red; margin-bottom: 10px;"></div>

        <!-- El formulario DEBE tener id="formLogin" -->
        <form id="formLogin">
            <input type="email" id="correoLogin" name="correo" placeholder="Ingresa tu Correo" required>
            <input type="password" id="passwordLogin" name="password" placeholder="Ingresa tu Contraseña" required>
            
            <button type="submit" class="btn-login">Iniciar Sesión</button>
        </form>

        <p>¿No tienes cuenta?</p>
        <a href="index.php?page=showRegister" class="btn-register">Registrarse</a>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/auth.js"></script>
</body>
</html>