    let mensajeR = document.getElementById("mensajeR");
    let mensajeError = document.getElementById("mensajeError");
    let login = document.getElementById("login");
    let registro = document.getElementById("registro");

    // Botones
    let btnIniciar = document.getElementById("btnIniciar");
    let btnRegistro = document.getElementById("btnRegistro");
    let btnGuardar = document.getElementById("btnGuardar");

    registro.style.display = "none";

    // Iniciar sesión
    btnIniciar.addEventListener("click", function () {

        let correo = document.getElementById("correoLogin").value;
        let password = document.getElementById("passwordLogin").value;

        if (correo == "" || password == "") {

            mensajeR.innerText = "Debe completar todos los campos";
            mensajeR.style.color = "red";

        } else {

            mensajeR.innerText = "Inicio de sesión correcto";
            mensajeR.style.color = "green";
        }

    });

    btnRegistro.addEventListener("click", function () {
        login.style.display = "none";
        registro.style.display = "block";
        
    }); 

    // Registrar a un usuario
    btnGuardar.addEventListener("click", function () {

        let nombre = document.getElementById("nombre").value;
        let correo = document.getElementById("correoRegistro").value;
        let password = document.getElementById("passwordRegistro").value;
        let rol = document.getElementById("rol").value;

        if (nombre == "" || correo == "" || password == "" || rol == "") {
            mensajeError.innerText = "Todos los campos deben ser llenados";
            mensajeError.style.color = "red";
        } else {
            mensajeError.innerText = "El nuevo usuario ha sido registrado correctamente";
            mensajeError.style.color = "green";

        }

    });

    // Volver al inicio de sesión
    btnVolver.addEventListener("click", function () {
        registro.style.display = "none";
        login.style.display = "block";
    });
