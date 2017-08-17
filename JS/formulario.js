function comprobarVacio(valor) {
    return valor == null || valor.length == 0 || /^\s+$/.test(valor);
}
function comprobarTelefono(valor) {
    return !/\+?[0-9]+/.test(valor);
}

function comprobarNumeroTarjeta(valor) {
    return !(/[0-9]+/.test(valor) && valor.length == 16);
}

function comprobarEmail(valor) {
    return !/\w+([-+.'_]\w+)*@\w+([-.]\w+)*\.\w+/.test(valor);
}

function mostrarError(input, elemento, mensaje) {
    if(typeof elemento === "string" && typeof mensaje === "string") {
        document.getElementById(elemento).innerHTML = mensaje;
        //document.getElementById(elemento).style.color = "#e60000";
        //document.getElementById(elemento).style.padding = "0 0 0 10px";
    }
    input.style.border = "2px solid red";
}

function ponerCorrecto(input, elemento) {
    if(typeof elemento === "string") {
        document.getElementById(elemento).innerHTML = "";
    }
    input.style.border = "1px solid #ccc";
}

function enviarFormulario() {
    var correcto = true;
    var nombre = document.getElementById("nombre");
    var telefono = document.getElementById("telefono");
    var email = document.getElementById("email");
    var mensaje = document.getElementById("mensaje");

    if(comprobarVacio(nombre.value)) {
        mostrarError(nombre, "s_nombre", "El nombre no puede estar vacio.");
        correcto = false;
    } else {
        ponerCorrecto(nombre, "s_nombre");
    }

    if(comprobarVacio(telefono.value)) {
        mostrarError(telefono, "s_telefono", "El teléfono no puede estar vacio.");
        correcto = false;
    } else if(comprobarTelefono(telefono.value)) {
        mostrarError(telefono, "s_telefono", "El teléfono no es correcto.");
        correcto = false;
    } else {
        ponerCorrecto(telefono, "s_telefono");
    }

    if(comprobarVacio(email.value)) {
        mostrarError(email, "s_email", "El e-mail no puede estar vacio.");
        correcto = false;
    } else if(comprobarEmail(email.value)) {
        mostrarError(email, "s_email", "El e-mail no es correcto.");
        correcto = false;
    } else {
        ponerCorrecto(email, "s_email");
    }

    if(comprobarVacio(mensaje.value)) {
        mostrarError(mensaje, "s_mensaje", "El mensaje no puede estar vacio.");
        correcto = false;
    } else {
        ponerCorrecto(mensaje, "s_mensaje");
    }

    if(correcto) {
        alert("Gracias por contactar con nosotros.\n" +
        "Intentaremos responderle lo antes posible.");
    }

    return correcto;
}

function enviarFormularioRegistro() {
    var correcto = true;
    var usuario = document.getElementById("usuario");
    var nombre = document.getElementById("nombre");
    var apellidos = document.getElementById("apellidos");
    var telefono = document.getElementById("telefono");
    var pass = document.getElementById("pass_registro");
    var repass = document.getElementById("repass_registro");    
    var email = document.getElementById("email");
    var direccion = document.getElementById("direccion");
    var id = document.getElementById("id");

    if(comprobarVacio(nombre.value)) {
        mostrarError(nombre, "s_nombre", "El nombre no puede estar vacio.");
        correcto = false;
    } else {
        ponerCorrecto(nombre, "s_nombre");
    }

    if(comprobarVacio(apellidos.value)) {
        mostrarError(apellidos, "s_apellidos", "Apellidos no puede estar vacio.");
        correcto = false;
    } else {
        ponerCorrecto(apellidos, "s_apellidos");
    }

    if(comprobarVacio(direccion.value)) {
        mostrarError(direccion, "s_direccion", "Apellidos no puede estar vacio.");
        correcto = false;
    } else {
        ponerCorrecto(direccion, "s_direccion");
    }

    if(comprobarVacio(id.value)) {
        mostrarError(id, "s_id", "Identificación no puede estar vacio.");
        correcto = false;
    } else {
        ponerCorrecto(id, "s_id");
    }

    if(comprobarVacio(usuario.value)) {
        mostrarError(usuario, "s_usuario", "El nombre de usuario no puede estar vacio.");
        correcto = false;
    } else {
        ponerCorrecto(usuario, "s_usuario");
    }

    if(comprobarVacio(telefono.value)) {
        mostrarError(telefono, "s_telefono", "El teléfono no puede estar vacio.");
        correcto = false;
    } else if(comprobarTelefono(telefono.value)) {
        mostrarError(telefono, "s_telefono", "El teléfono no es correcto.");
        correcto = false;
    } else {
        ponerCorrecto(telefono, "s_telefono");
    }

    if(comprobarVacio(email.value)) {
        mostrarError(email, "s_email", "El e-mail no puede estar vacio.");
        correcto = false;
    } else if(comprobarEmail(email.value)) {
        mostrarError(email, "s_email", "El e-mail no es correcto.");
        correcto = false;
    } else {
        ponerCorrecto(email, "s_email");
    }

    if(comprobarVacio(pass.value)) {
        mostrarError(pass, "s_pass", "La contraseña no puede estar vacia.");
        correcto = false;
    } else if (pass.value != repass.value){
        mostrarError(pass, "s_pass", "Las contraseñas deben coincidir.");
        mostrarError(repass, "s_repass", "Las contraseñas deben coincidir.");
        correcto = false;
    }else{
        ponerCorrecto(pass, "s_pass");  
        ponerCorrecto(repass, "s_repass");  
    }


    return correcto;
}

function enviarFormularioPago() {
    var correcto = true;    
    var nombre = document.getElementById("nombre");
    var apellidos = document.getElementById("apellidos");
    var telefono = document.getElementById("telefono");    
    var email = document.getElementById("email");
    var direccion = document.getElementById("direccion");
    var id = document.getElementById("id");
    var tarjeta = document.getElementById("tarjeta");

    if(comprobarVacio(nombre.value)) {
        mostrarError(nombre, "s_nombre", "El nombre no puede estar vacio.");
        correcto = false;
    } else {
        ponerCorrecto(nombre, "s_nombre");
    }

    if(comprobarVacio(apellidos.value)) {
        mostrarError(apellidos, "s_apellidos", "Apellidos no puede estar vacio.");
        correcto = false;
    } else {
        ponerCorrecto(apellidos, "s_apellidos");
    }

    if(comprobarVacio(direccion.value)) {
        mostrarError(direccion, "s_direccion", "Apellidos no puede estar vacio.");
        correcto = false;
    } else {
        ponerCorrecto(direccion, "s_direccion");
    }

    if(comprobarVacio(id.value)) {
        mostrarError(id, "s_id", "Identificación no puede estar vacio.");
        correcto = false;
    } else {
        ponerCorrecto(id, "s_id");
    }

    
    if(comprobarVacio(telefono.value)) {
        mostrarError(telefono, "s_telefono", "El teléfono no puede estar vacio.");
        correcto = false;
    } else if(comprobarTelefono(telefono.value)) {
        mostrarError(telefono, "s_telefono", "El teléfono no es correcto.");
        correcto = false;
    } else {
        ponerCorrecto(telefono, "s_telefono");
    }

    if(comprobarVacio(tarjeta.value)) {
        mostrarError(tarjeta, "s_tarjeta", "El número de tarjeta no puede estar vacio.");
        correcto = false;
    } else if(comprobarNumeroTarjeta(tarjeta.value)) {
        mostrarError(tarjeta, "s_tarjeta", "El número de tarjeta no es correcto.");
        correcto = false;
    } else {
        ponerCorrecto(tarjeta, "s_tarjeta");
    }

    if(comprobarVacio(email.value)) {
        mostrarError(email, "s_email", "El e-mail no puede estar vacio.");
        correcto = false;
    } else if(comprobarEmail(email.value)) {
        mostrarError(email, "s_email", "El e-mail no es correcto.");
        correcto = false;
    } else {
        ponerCorrecto(email, "s_email");
    }

    

    return correcto;
}

function enviarBuscarReserva() {
    var correcto = true;
    var f_entrada = document.getElementById("fechaEntrada");
    var f_salida = document.getElementById("fechaSalida");

    var f_e = new Date(f_entrada.value);
    var f_s = new Date(f_salida.value);


   
    if(f_s <= f_e) {
        mostrarError(f_salida, "s_fechas", "Fecha de salida tiene que ser posteriora fecha de entrada.");
        correcto = false;
    } else {
        ponerCorrecto(f_salida, "s_fechas");
    }

    return correcto;
}
