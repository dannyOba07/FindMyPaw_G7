function cambiarEstado(idSolicitud, idEstado) {

    $.post("./actualizar_solicitud.php", { id_solicitud: idSolicitud, id_estado: idEstado }, function (data) {

        if (data.response == "00") {
            alert(data.message);
            location.reload();
        } else {
            alert(data.message);
        }

    }, "json");
}