$(function () {
    const urlBase = "../index.php";

    // ── Login ────────────────────────────────────────────
    $('#formLogin').on('submit', function (e) {
        e.preventDefault();
        $('#loginError').addClass('d-none').text('');

        const correo = $('#correoLogin').val();
        const password = $('#passwordLogin').val();

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
                window.location = 'catalogo.php';
            } else {
                $('#loginError').removeClass('d-none').text(res.message);
            }
        }, 'json');
    });

    // ── Registro ─────────────────────────────────────────
    $('#formRegister').on('submit', function (e) {
        e.preventDefault();
        $('#registerError, #registerSuccess').addClass('d-none').text('');

        $.post(urlBase, {
            nombre: $('#regNombre').val(),
            apellido_paterno: $('#regApellidoPaterno').val(),
            apellido_materno: $('#regApellidoMaterno').val(),
            correo: $('#regCorreo').val(),
            telefono: $('#regTelefono').val(),
            direccion: $('#regDireccion').val(),
            password: $('#regPassword').val(),
            id_rol: $('#regRol').val(),
            option: 'register'
        }, function (res) {
            if (res.response === '00') {
                $('#registerSuccess').removeClass('d-none').text('Registro exitoso. Redirigiendo...');
                setTimeout(() => window.location.href = 'login.php', 1500);
            } else {
                $('#registerError').removeClass('d-none').text(res.message);
            }
        }, 'json');
    });

    // ── Logout ───────────────────────────────────────────
    $('#btnLogout').on('click', function () {
        $.post(urlBase, { option: 'logout' }, function () {
            window.location.href = 'login.php';
        });
    });
});