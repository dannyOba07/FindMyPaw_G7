$(function () {
    const urlBase = "/proyecto/FindMyPaw_G7/index.php";

    function cargarPerfil() {
        $.get(urlBase, { option: "profile" }, function (res) {
            if (res.response !== "00") {
                window.location.href = "/proyecto/FindMyPaw_G7/index.php?page=login";
                return;
            }
            $("#perfilCorreo").text(res.user.CORREO);
            $("#perfilRol").text(res.user.ID_ROL);
            $("#nombre").val(res.user.NOMBRE_USUARIO);
            $("#apellidoPaterno").val(res.user.APELLIDO_PATERNO);
            $("#apellidoMaterno").val(res.user.APELLIDO_MATERNO);
            $("#telefono").val(res.user.TELEFONO);
            $("#direccion").val(res.user.DIRECCION);
        }, "json");
    }

    $("#formPerfil").on("submit", function (e) {
        e.preventDefault();
        $("#perfilError, #perfilSuccess").addClass("d-none").text("");

        $.post(urlBase, {
            nombre: $("#nombre").val(),
            apellido_paterno: $("#apellidoPaterno").val(),
            apellido_materno: $("#apellidoMaterno").val(),
            telefono: $("#telefono").val(),
            direccion: $("#direccion").val(),
            option: "updateProfile"
        }, function (res) {
            if (res.response === "00") {
                $("#perfilSuccess").removeClass("d-none").text(res.message);
            } else {
                $("#perfilError").removeClass("d-none").text(res.message);
            }
        }, "json");
    });

    $('#btnLogout').on('click', function (e) {
        e.preventDefault(); 
        
        $.post(urlBase, { option: "logout" }, function () {
            window.location.href = '/proyecto/FindMyPaw_G7/index.php?page=login';
        });
    });

    cargarPerfil();
});