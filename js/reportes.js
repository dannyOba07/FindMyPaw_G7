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
    let tamano = document.getElementById("tamano").value;
    let color = document.getElementById("color").value;
    let sexo = document.getElementById("sexo").value;
    let estadoSalud = document.getElementById("estadoSalud").value;
    let ubicacion = document.getElementById("ubicacion").value;
    let descripcion = document.getElementById("descripcion").value;

    if (
        tipoReporte == "" ||
        tamano == "" ||
        color == "" ||
        sexo == "" ||
        estadoSalud == "" ||
        ubicacion == "" ||
        descripcion == ""
    ) {
        mensajeReporte.innerText = "Debe completar todos los campos obligatorios";
        mensajeReporte.style.color = "red";
    } else {
        console.log("Simulando INSERT en PERROS y REPORTES");
        console.log({
            TIPO_REPORTE: tipoReporte,
            TAMANO: tamano,
            COLOR: color,
            SEXO: sexo,
            ESTADO_SALUD: estadoSalud,
            UBICACION: ubicacion,
            DESCRIPCION: descripcion
        });

        mensajeReporte.innerText = "Reporte registrado correctamente";
        mensajeReporte.style.color = "green";

        formulario.reset();
        vistaPrevia.src = "";
        vistaPrevia.style.display = "none";
        eliminarImagen.style.display = "none";
    }
});