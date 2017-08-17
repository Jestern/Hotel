<?php 
/*
ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE);
*/
require './bd_conexion.php';
require './class_content.php';
session_start();



class Reservas{

    function __construct($conexion, $dni, $nom)
    {
        $this->cancelar = 'Cancelar reserva';
        $this->confirmar = 'Confirmar reserva';
        $this->confirmadas = 'RESERVAS CONFIRMADAS';
        $this->sinConfirmar = 'RESERVAS SIN CONFIRMAR';
        $this->reservas_confirmadas = array();
        $this->reservas_no_confirmadas = array();

        $seleccion = "";

        if($dni !== ""){           
            $seleccion = 'SELECT * FROM Reserva WHERE identificacion LIKE "'.$dni.'%" ORDER BY fecha DESC';
           
        }else if($nom !== ""){
            $seleccion = 'SELECT * FROM Reserva r, Cliente c WHERE r.identificacion=c.identificacion AND c.apellidos LIKE "'.$nom.'%" ORDER BY r.fecha DESC';
        }else{
            $seleccion = 'SELECT * FROM Reserva ORDER BY fecha DESC';
        }
        
        $resultado = mysql_query ($seleccion, $conexion);
        // Averiguamos cuántas filas ha devuelto la consulta
        if (!$resultado) {
            $mensaje  = 'Consulta no válida: ' . mysql_error() . "\n";
            $mensaje .= 'Consulta completa: ' . $seleccion;
            die($mensaje);
        }
        $numFilas = mysql_num_rows ($resultado);

        // Si la consulta ha devuelto filas, las procesamos,
        if($numFilas > 0){

            while($fila = mysql_fetch_assoc ($resultado)){
                $selec = 'SELECT * FROM Reserva r, ReservaHabitacion h WHERE r.identificador=h.identificador AND r.identificador = "'. $fila["identificador"] .'"';
                $result = mysql_query ($selec, $conexion);
                $habitaciones = array();
                while($f = mysql_fetch_assoc ($result)){

                    array_push($habitaciones, $f["tipo"]);
                }

                $selec = 'SELECT nombre , apellidos  FROM Cliente  WHERE identificacion = "'. $fila["identificacion"] .'"';
                $result = mysql_query ($selec, $conexion);

                $numFilas = mysql_num_rows ($resultado);
                if($numFilas > 0){
                    $f = mysql_fetch_assoc ($result);
                    $nombre = $f["nombre"] . " " . $f["apellidos"];
                }

                $selec = 'SELECT *  FROM ReservaActividad  WHERE nombreActividad = "VISITA A LA ALHAMBRA" AND identificador="'. $fila["identificador"] .'"';
                $result = mysql_query ($selec, $conexion);

                $al = 0;
                if(mysql_num_rows ($result)!=0){
                    $f = mysql_fetch_assoc ($result);
                    $al = $f["cantidad"];
                }

                $selec = 'SELECT *  FROM ReservaActividad  WHERE nombreActividad = "EXCURSIÓN A SIERRA NEVADA" AND identificador="'. $fila["identificador"] .'"';
                $result = mysql_query ($selec, $conexion);

                $sie = 0;
                if(mysql_num_rows ($result)!=0){
                    $f = mysql_fetch_assoc ($result);
                    $sie = $f["cantidad"];
                }



                if($fila["estado"] == "Confirmada"){
                    array_push($this->reservas_confirmadas, new Reserva($fila["identificador"],
                  $fila["identificacion"], $nombre, $fila["fecha"], $fila["fechaEntrada"], $fila["fechaSalida"], $habitaciones, $sie, $al, $fila["ninios"], $fila["adultos"]));
                }else if ($fila["estado"] == "SinConfirmar"){
                    array_push($this->reservas_no_confirmadas, new Reserva($fila["identificador"],
                  $fila["identificacion"], $nombre, $fila["fecha"], $fila["fechaEntrada"], $fila["fechaSalida"], $habitaciones, $sie, $al, $fila["ninios"], $fila["adultos"]));
                }

            }

        }
    }

    function showReservas()
    {
        
        echo '
            <div class="row">
                <div class="resrvascontainer col-md-5 col-lg-5 col-sm-12 col-xs-12">
                        <h4 class="text-center">' . $this->confirmadas . '</h4>
                        <div class="divider"></div>';


                        foreach ($this->reservas_confirmadas as $r) {
                            echo '<div class="fondo-blanco margenes">
                            <div class="row margenes">
                                <p>Identificador: '. $r->getTextIdentificador() .'<br>Identificación cliente: '. $r->getTextIdentificacion() .' <br>Nombre cliente: '. $r->getTextName() .'<br>Fecha reserva: '. $r->getTextFecha() .'<br>Fecha entrada: '. $r->getTextFecha_e() .'<br>Fecha salida: '. $r->getTextFecha_s() .'<br>Actividad Alhambra: '. $r->getTextAlhambra() .'<br>Actividad Sierra: '. $r->getTextSierra() .'<br>Número de adultos: '. $r->getTextAdultos() .'<br>Número de niños: '. $r->getTextNinios() .'</p>
                            </div>

                            <div class="row margenes text-center">';
                            $habs = $r->getTextHabitaciones();
                               foreach ($habs as $h) {
                                
                                echo '<p> '. $h .'</p>';
                               }
                           echo '
                           </div>
                           <form method="post" action="./PHP/operaciones_reserva.php">
                                <input type="hidden" name="cancelar" value="' . $r->getTextIdentificador() . '">
                                <input type="submit" class="botonSig" value="'. $this->cancelar .'">
                            </form>
                            </div> ';
                        }

                    echo '</div>
                    <div class="resrvascontainer col-md-5 col-lg-5 col-sm-12 col-md-push-1 col-lg-push-1 col-sm-push-0 col-xs-push-0 col-xs-12">
                        <h4 class="text-center">'. $this->sinConfirmar .'</h4>
                        <div class="divider"></div> ';
                        
                        foreach ($this->reservas_no_confirmadas as $r) {
                            echo '<div class="fondo-blanco margenes">
                            <div class="row margenes">
                                <p>Identificador:'. $r->getTextIdentificador() .'<br>Identificación cliente: '. $r->getTextIdentificacion() .' <br>Nombre cliente:'. $r->getTextName() .'<br>Fecha reserva:'. $r->getTextFecha() .'<br>Fecha entrada:'. $r->getTextFecha_e() .'<br>Fecha salida:'. $r->getTextFecha_s() .'<br>Actividad Alhambra: '. $r->getTextAlhambra() .'<br>Actividad Sierra: '. $r->getTextSierra() .'<br>Número de adultos: '. $r->getTextAdultos() .'<br>Número de niños: '. $r->getTextNinios() .'</p>
                            </div>
                            <div class="row margenes text-center">';
                        $habs = $r->getTextHabitaciones();
                           foreach ($habs as $h) {
                            echo '<p> '. $h .'</p>';
                           }
                       echo '
                       </div>
                       <form method="post" action="./PHP/operaciones_reserva.php">
                            <input type="hidden" name="cancelar" value="' . $r->getTextIdentificador() . '">
                            <input type="submit" class="botonSig" value="'. $this->cancelar .'">
                        </form>
                        <p><br></p>
                        <form method="post" action="./PHP/operaciones_reserva.php">
                             <input type="hidden" name="confirmar" value="' . $r->getTextIdentificador() . '">
                             <input type="submit" class="botonSig" value="'. $this->confirmar .'">
                         </form>
                        </div> ';
                        }

                   echo ' </div>
             </div>';
            }

}

$q = $_POST["id"];

$dni = "";
$nom = "";

if ($q !== "") {
    if(is_numeric($q[0])){
        $dni = $q;
    }else{
        $nom = $q;
    }     
}

$res = new Reservas($conexion, $dni, $nom);
$res->showReservas();

require './bd_desconexion.php';

 ?>