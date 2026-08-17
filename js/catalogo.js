function solicitarAdopcion(idPerro, nombrePerro) {
    let comentario = prompt("Para procesar tu solicitud de adopción para " + nombrePerro + ", por favor escribe un breve comentario de por qué deseas adoptarlo:");

    if (comentario === null) {
        return; 
    }

    if (comentario.trim() === "") {
        alert("Debes ingresar un comentario para poder enviar la solicitud.");
        return;
    }

    // Petición real al servidor
    $.post("index.php", {
        option: "guardarSolicitud",
        id_perro: idPerro,
        comentario: comentario
    }, function (res) {
        if (res.response === '00') {
            alert(res.message);
            location.reload(); 
        } else {
            alert("Error: " + res.message);
        }
    }, 'json').fail(function () {
        alert("Ocurrió un error al procesar la solicitud.");
    });
}