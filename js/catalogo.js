// js/catalogo.js

// Lógica del botón Filtrar
document.getElementById("btnFiltrar").addEventListener("click", function() {
    let edad = document.getElementById("filtroEdad").value;
    let ubicacion = document.getElementById("filtroUbicacion").value;

   
    console.log("Enviando parámetros al servidor -> Estado: 9 (En adopción), Edad máxima: " + edad + ", Ubicación: " + ubicacion);
    alert("Buscando mascotas disponibles con los filtros seleccionados...");
});

// Función para el botón Solicitar Adopción
function solicitarAdopcion(idPerro, nombrePerro) {
    let comentario = prompt("Para procesar tu solicitud de adopción para " + nombrePerro + ", por favor escribe un breve comentario de por qué deseas adoptarlo:");

    if (comentario === null) {
        
        return; 
    }

    if (comentario.trim() === "") {
        alert(" Debes ingresar un comentario para poder enviar la solicitud.");
    } else {
       
        console.log("Simulando INSERT en SOLICITUDES_ADOPCION:");
        console.log({
            ID_PERRO: idPerro,
            ID_USUARIO: 1, 
            ID_ESTADO: 3,  
            FECHA_SOLICITUD: new Date().toISOString().split('T')[0],
            COMENTARIO: comentario
        });

        alert(" ¡Tu solicitud para adoptar a " + nombrePerro + " ha sido enviada con éxito! Queda en estado 'Pendiente' de revisión.");
    }
}