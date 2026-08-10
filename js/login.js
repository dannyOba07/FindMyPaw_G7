   $(function () {
    const urlBase = "../index.php";

    $("#formLogin").on("submit", function (event) {
        event.preventDefault();
        const correo = $("#correo");
        const password = $("#password");

        if (correo.val() === "" || password.val() === "") {
            alert("Debe completar todos los campos");
            return;
        }

        $.post(urlBase, {
            correo: correo.val(),
            password: password.val(),
            option: "login"
        }, function (data) {
            data = JSON.parse(data);
            if (data.response === "00") {
                window.location = "catalogo.php";
            } else {
                alert(data.message);
            }
        });
    });

    $('#formRegister').on('submit', function (e) {
        e.preventDefault();

        const password = $('#regPassword').val();
        const confirm = $('#regConfirm').val();

        $('#registerError, #registerSuccess').addClass('d-none').text('');

        if (password !== confirm) {
            $('#registerError').removeClass('d-none').text('Las contraseñas no coinciden');
            return;
        }

        $.post(urlBase, {
            correo: $('#regCorreo').val(),
            password: password,
            confirm_password: confirm,
            id_rol: $('#regRol').val(),
            nombre: $('#regNombre').val(),
            apellido_paterno: $('#regApellidoPaterno').val(),
            apellido_materno: $('#regApellidoMaterno').val(),
            telefono: $('#regTelefono').val(),
            direccion: $('#regDireccion').val(),
            option: "register"
        }, function (res) {
            if (res.response === '00') {
                $('#registerSuccess').removeClass('d-none').text('Registro exitoso. Redirigiendo...');
                setTimeout(() => window.location.href = 'login.php', 1500);
            } else {
                $('#registerError').removeClass('d-none').text(res.message);
            }
        }, 'json');
    });

    $('#btnLogout').on('click', function () {
        $.post(urlBase, { option: "logout" }, function () {
            window.location.href = 'login.php';
        });
    });
});