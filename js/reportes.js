let formulario = document.getElementById("formReporte");
let imagen = document.getElementById("imagen");
let vistaPrevia = document.getElementById("vistaPrevia");
let eliminarImagen = document.getElementById("eliminarImagen");
let mensajeReporte = document.getElementById("mensajeReporte");

imagen.addEventListener("change", function () {

    let archivo = imagen.files[0];

    if (archivo) {

        let lector = new FileReader();

        lector.onload = function (event) {
            vistaPrevia.src = event.target.result;
            vistaPrevia.style.display = "block";
            eliminarImagen.style.display = "block";
        };

        lector.readAsDataURL(archivo);
    }
});


eliminarImagen.addEventListener("click", function () {

    imagen.value = "";
    vistaPrevia.src = "";
    vistaPrevia.style.display = "none";
    eliminarImagen.style.display = "none";

});


formulario.addEventListener("submit", function (event) {

    event.preventDefault();

    let tipoReporte = document.getElementById("tipoReporte").value;
    let nombrePerro = document.getElementById("nombrePerro").value;
    let raza = document.getElementById("raza").value;
    let edad = document.getElementById("edad").value;
    let tamano = document.getElementById("tamano").value;
    let color = document.getElementById("color").value;
    let sexo = document.getElementById("sexo").value;
    let estadoSalud = document.getElementById("estadoSalud").value;
    let ubicacion = document.getElementById("ubicacion").value;
    let descripcion = document.getElementById("descripcion").value;

    if (
        tipoReporte == "" ||
        edad == "" ||
        tamano == "" ||
        color == "" ||
        sexo == "" ||
        estadoSalud == "" ||
        ubicacion == "" ||
        descripcion == ""
    ) {

        mensajeReporte.innerText =
            "Debe completar todos los campos obligatorios";

        mensajeReporte.style.color = "red";

    } else {

        let datos = new FormData();

        datos.append("tipoReporte", tipoReporte);
        datos.append("nombrePerro", nombrePerro);
        datos.append("raza", raza);
        datos.append("edad", edad);
        datos.append("tamano", tamano);
        datos.append("color", color);
        datos.append("sexo", sexo);
        datos.append("estadoSalud", estadoSalud);
        datos.append("ubicacion", ubicacion);
        datos.append("descripcion", descripcion);

        if (imagen.files[0]) {
            datos.append("imagen", imagen.files[0]);
        }

        fetch("../guardar_reporte.php", {
            method: "POST",
            body: datos
        })
        .then(response => response.text())
        .then(respuesta => {

            mensajeReporte.innerText = respuesta;

            if (respuesta == "Reporte registrado correctamente") {

                mensajeReporte.style.color = "green";

                formulario.reset();

                vistaPrevia.src = "";
                vistaPrevia.style.display = "none";

                eliminarImagen.style.display = "none";

            } else {

                mensajeReporte.style.color = "red";
            }

        })
        .catch(error => {

            console.log(error);

            mensajeReporte.innerText =
                "Error al registrar el reporte";

            mensajeReporte.style.color = "red";

        });
    }

});