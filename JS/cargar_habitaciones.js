

function cargar_disponibles() {

        var xmlhttp = new XMLHttpRequest();
       
        xmlhttp.onreadystatechange = function() {
          
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("habitaciones_disponibles").innerHTML = xmlhttp.responseText;
                
            }

        };       
        xmlhttp.open("GET", "./PHP/habitaciones_reserva.php", true);
        xmlhttp.send();
   
}

function aniadir_habitacion(ref, desayuno) {
        var xmlhttp = new XMLHttpRequest();
       
        xmlhttp.onreadystatechange = function() {
            
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("habitaciones_disponibles").innerHTML = xmlhttp.responseText;
                cargar_resumen("reservar");
            }

        };       
        xmlhttp.open("POST", "./PHP/habitaciones_reserva.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("add="+ ref +"&desayuno="+desayuno);
}

function cargar_resumen(page){
     var xmlhttp = new XMLHttpRequest();
       
        xmlhttp.onreadystatechange = function() {
           
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("resumen").innerHTML = xmlhttp.responseText;
                
            }

        };       
        xmlhttp.open("GET", "./PHP/side_reserva.php?page="+page, true);
        xmlhttp.send();
}

function quitar_habitacion(ref) {
        var xmlhttp = new XMLHttpRequest();
       
        xmlhttp.onreadystatechange = function() {
           
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("habitaciones_disponibles").innerHTML = xmlhttp.responseText;
                cargar_resumen("reservar");
            }

        };       
        xmlhttp.open("POST", "./PHP/habitaciones_reserva.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("remove="+ ref);
}

function aniadir_actividad(ref) {
        var xmlhttp = new XMLHttpRequest();
       
        xmlhttp.onreadystatechange = function() {
           
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                
                cargar_resumen("reservarActividades");
            }

        };       
        xmlhttp.open("POST", "./PHP/actividades_reserva.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("add="+ ref);
}
function quitar_actividad(ref) {
        var xmlhttp = new XMLHttpRequest();
       
        xmlhttp.onreadystatechange = function() {
            
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                
                cargar_resumen("reservarActividades");
            }

        };       
        xmlhttp.open("POST", "./PHP/actividades_reserva.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("remove="+ ref);
}

function mostrar_reservas(n) {
        var xmlhttp = new XMLHttpRequest();
       
        xmlhttp.onreadystatechange = function() {
            
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("reservas").innerHTML = xmlhttp.responseText;
              
            }

        };       
        xmlhttp.open("POST", "./PHP/reservas_admin.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("id="+ n);
}