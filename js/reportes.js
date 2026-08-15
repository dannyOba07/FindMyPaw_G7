document.addEventListener("DOMContentLoaded", () => {
    const formulario = document.getElementById("formReporte");
    const imagenInput = document.getElementById("imagen");
    const vistaPrevia = document.getElementById("vistaPrevia");
    const btnEliminarImagen = document.getElementById("eliminarImagen");
    const mensajeReporte = document.getElementById("mensajeReporte");

    // Si el formulario no existe en la vista actual (ej. lista.php), interrumpe la ejecución sin lanzar error
    if (!formulario) return;

    // Función auxiliar para reiniciar el control de la imagen
    const resetearVistaPrevia = () => {
        if (imagenInput) imagenInput.value = "";
        if (vistaPrevia) {
            vistaPrevia.src = "";
            vistaPrevia.style.display = "none";
        }
        if (btnEliminarImagen) btnEliminarImagen.style.display = "none";
    };

    // Previsualización de la imagen cargada
    if (imagenInput) {
        imagenInput.addEventListener("change", () => {
            const [archivo] = imagenInput.files;

            if (archivo && vistaPrevia && btnEliminarImagen) {
                const lector = new FileReader();
                lector.onload = (e) => {
                    vistaPrevia.src = e.target.result;
                    vistaPrevia.style.display = "block";
                    btnEliminarImagen.style.display = "block";
                };
                lector.readAsDataURL(archivo);
            }
        });
    }

    // Evento para limpiar la selección de imagen
    if (btnEliminarImagen) {
        btnEliminarImagen.addEventListener("click", resetearVistaPrevia);
    }

    // Procesamiento y envío del formulario
    formulario.addEventListener("submit", async (event) => {
        event.preventDefault();

        const camposRequeridos = [
            "tipoReporte", "edad", "tamano", 
            "color", "sexo", "estadoSalud", 
            "ubicacion", "descripcion"
        ];

        // Validación de campos vacíos o con solo espacios
        const estaIncompleto = camposRequeridos.some(id => {
            const valor = document.getElementById(id)?.value ?? "";
            return valor.trim() === "";
        });

        if (estaIncompleto) {
            if (mensajeReporte) {
                mensajeReporte.innerText = "Debe completar todos los campos obligatorios.";
                mensajeReporte.style.color = "red";
            }
            return;
        }

        const datos = new FormData(formulario);

        try {
            const respuesta = await fetch("./guardar_reporte.php", {
                method: "POST",
                body: datos
            });

            if (!respuesta.ok) throw new Error(`HTTP error! status: ${respuesta.status}`);

            const resultado = await respuesta.text();
            
            if (mensajeReporte) {
                mensajeReporte.innerText = resultado;

                if (resultado.trim() === "Reporte registrado correctamente") {
                    mensajeReporte.style.color = "green";
                    formulario.reset();
                    resetearVistaPrevia();
                } else {
                    mensajeReporte.style.color = "red";
                }
            }

        } catch (error) {
            console.error("Error en la solicitud:", error);
            if (mensajeReporte) {
                mensajeReporte.innerText = "Error al registrar el reporte.";
                mensajeReporte.style.color = "red";
            }
        }
    });
});