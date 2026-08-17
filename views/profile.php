<link rel="stylesheet" href="css/perfil.css">
<?php include __DIR__ . '/navbar.php'; ?>

<div class="contenedor-perfil">
    <header>
        <h1>Mi Perfil</h1>
        <p>Administra tu información personal y datos de cuenta</p>
    </header>

    <!-- Alertas dinámicas -->
    <div id="perfilError" class="alert alert-danger d-none"></div>
    <div id="perfilSuccess" class="alert alert-success d-none"></div>

    <!-- Datos de solo lectura -->
    <div class="info-grupo">
        <label>Correo electrónico:</label>
        <p id="perfilCorreo">-</p>
    </div>

    <div class="info-grupo">
        <label>Rol en el sistema:</label>
        <p id="perfilRol">-</p>
    </div>

    <hr>

    <!-- Formulario de Edición -->
    <form id="formPerfil">
        <div class="form-grupo">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>

        <div class="form-grupo">
            <label for="apellidoPaterno">Apellido Paterno</label>
            <input type="text" id="apellidoPaterno" name="apellido_paterno">
        </div>

        <div class="form-grupo">
            <label for="apellidoMaterno">Apellido Materno</label>
            <input type="text" id="apellidoMaterno" name="apellido_materno">
        </div>

        <div class="form-grupo">
            <label for="telefono">Teléfono</label>
            <input type="text" id="telefono" name="telefono">
        </div>

        <div class="form-grupo">
            <label for="direccion">Dirección</label>
            <textarea id="direccion" name="direccion" rows="3"></textarea>
        </div>

        <div class="acciones-perfil">
            <button type="submit" class="btn-actualizar">Actualizar Perfil</button>
            <button type="button" id="btnLogout" class="btn-logout">Cerrar Sesión</button>
        </div>
    </form>
</div>

<!-- Scripts necesarios -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="js/perfil.js"></script>