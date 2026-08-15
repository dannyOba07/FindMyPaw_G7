$(function () {
    // Apunta al archivo actual dinámicamente evitando problemas de subcarpetas
    const urlBase = './index.php'; 

    // ── Login ────────────────────────────────────────────
    $('#formLogin').on('submit', function (e) {
        e.preventDefault();
        $('#loginError').addClass('d-none').text('');

        const correo = $('#correoLogin').val().trim();
        const password = $('#passwordLogin').val().trim();

        if (correo === '' || password === '') {
            $('#loginError').removeClass('d-none').text('Debe completar todos los campos');
            return;
        }

        $.post(urlBase, {
            correo: correo,
            password: password,
            option: 'login'
        }, function (res) {
            if (res.response === '00') {
                window.location.href = 'index.php?page=catalogo';
            } else {
                $('#loginError').removeClass('d-none').text(res.message || 'Credenciales incorrectas');
            }
        }, 'json').fail(function(xhr, status, error) {
            console.error("Error servidor:", xhr.responseText);
            $('#loginError').removeClass('d-none').text('Error de conexión con el servidor.');
        });
    });

    // ── Registro ─────────────────────────────────────────
    $('#formRegister').on('submit', function (e) {
        e.preventDefault();
        $('#registerError, #registerSuccess').addClass('d-none').text('');

        $.post(urlBase, {
            nombre: $('#regNombre').val().trim(),
            apellido_paterno: $('#regApellidoPaterno').val().trim(),
            apellido_materno: $('#regApellidoMaterno').val().trim(),
            correo: $('#regCorreo').val().trim(),
            telefono: $('#regTelefono').val().trim(),
            direccion: $('#regDireccion').val().trim(),
            password: $('#regPassword').val().trim(),
            confirm_password: $('#regConfirmPassword').val().trim(),
            id_rol: $('#regRol').val(),
            option: 'register'
        }, function (res) {
            if (res.response === '00') {
                $('#registerSuccess').removeClass('d-none').text('Registro exitoso. Redirigiendo...');
                setTimeout(() => window.location.href = 'index.php?page=login', 1500);
            } else {
                $('#registerError').removeClass('d-none').text(res.message || 'Error en el registro');
            }
        }, 'json').fail(function(xhr) {
            console.error("Error registro:", xhr.responseText);
            $('#registerError').removeClass('d-none').text('Error al procesar el registro.');
        });
    });

    // ── Logout ───────────────────────────────────────────
    $('#btnLogout').on('click', function () {
        $.post(urlBase, { option: 'logout' }, function () {
            window.location.href = 'index.php?page=login';
        });
    });
});