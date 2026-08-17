function cambiarEstado(idSolicitud, idEstado) {
    $.post("index.php", {
        option: "actualizarEstadoSolicitud", 
        id_solicitud: idSolicitud,
        id_estado: idEstado
    }, function (data) {
        if (data.response == "00") {
            alert(data.message);
            location.reload();
        } else {
            alert(data.message);
        }
    }, "json").fail(function() {
        alert("Error de conexión con el servidor.");
    });
}