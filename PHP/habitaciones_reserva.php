<?php 
/*
ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE);
*/
require './bd_conexion.php';
require './class_content.php';
session_start();

class ReservasHabitaciones
{

    function __construct($conexion)
    {

        $this->fechaEntrada = $_SESSION["fechaEntrada"];
        $this->fechaSalida = $_SESSION["fechaSalida"];
        $this->adultos = $_SESSION["adultos"];
        $this->ninios = $_SESSION["ninios"];
        
        // Ejecutamos una consulta
        $seleccion = 'SELECT h.tipo, h.ref, h.pax, h.cantidad, h.precio, h.precioDesayuno, h.precioFestivos, i.path, (SELECT COUNT(*) FROM Reserva r, ReservaHabitacion rh WHERE rh.identificador = r.identificador AND h.tipo=rh.tipo AND r.fechaEntrada < ' . $this->fechaSalida . ' AND r.fechaSalida > ' . $this->fechaEntrada . ' AND r.estado="Cancelada") AS n FROM Habitacion h, Imagen i WHERE h.idImagen=i.idImagen';
        $resultado = mysql_query ($seleccion, $conexion);
        // Averiguamos cuántas filas ha devuelto la consulta

        if (!$resultado) {
            $mensaje  = 'Consulta no válida: ' . mysql_error() . "\n";
            $mensaje .= 'Consulta completa: ' . $seleccion;
            die($mensaje);
        }

        $this->allHabitaciones = array();
        $doblesTriples = 0;
        while ($fila = mysql_fetch_assoc ($resultado)) {
         $this->allHabitaciones[$fila["ref"]] = new Habitacion($fila["tipo"], "", $fila["path"], $fila["ref"], $fila["precio"], $fila["precioDesayuno"], $fila["precioFestivos"], $fila["cantidad"], $fila["n"], $fila["pax"]);
         if ($fila["tipo"] = "HABITACION DOBLE" or $fila["tipo"] == "HABITACION TRIPLE") {
             $doblesTriples += $fila["n"];
         }
        }
        foreach ($this->allHabitaciones as $key => $hab) {
            if(!strcmp($hab->getTitle(), "HABITACION DOBLE") or !strcmp($hab->getTitle(), "HABITACION TRIPLE")) {

                $hab->setOcupadas($doblesTriples);
            }
        }


    }

    function showHabs() {
    	$disponibles = "";
        $this->habitaciones = array();
        $nHabs = array();
        foreach ($_SESSION["habitaciones"] as $key => $hab) {
            if(!isset($nHabs[$hab->getRef()])) {
                $nHabs[$hab->getRef()] = 0;
            }

            $nHabs[$hab->getRef()] = $nHabs[$hab->getRef()] + 1;
        }
        foreach ($this->allHabitaciones as $key => $hab) {
        	
        	$suma = $this->adultos + $this->ninios;
        	

        	if(($suma == 1) && ($hab->getPax() == 1)){
        		 if($hab->getCantidad() > ($hab->getOcupadas() + $nHabs[$hab->getRef()])) {
                    $this->habitaciones[$hab->getRef()] = $hab;

                }
        	}else if(($hab->getPax()%2 == 0) && ($suma%2 == 0)) {
                if($hab->getCantidad() > ($hab->getOcupadas() + $nHabs[$hab->getRef()])) {
                    $this->habitaciones[$hab->getRef()] = $hab;

                }
            }else if(($suma%2 != 0) && $suma != 1){
            	if($hab->getCantidad() > ($hab->getOcupadas() + $nHabs[$hab->getRef()])) {
                    $this->habitaciones[$hab->getRef()] = $hab;

                }
            }

        }
        foreach ($this->habitaciones as $key => $hab) {
            $disponibles = $disponibles . '<div class="row reservaHab margenes">
                <h3>' . $hab->getTitle() . '</h3>
                <div class="col-md-12 col-lg-4 col-xs-12 col-sm-12">
                    <img src="' . $hab->getImg() . '" width="170" />
                </div>
                <div class="col-md-9 col-lg-8 col-sm-12 col-xs-12">
                    <div class="row margenes fondo-blanco">
                        <div class="text-center col-md-5">
                            <p>habitacion sin desayuno ' . strval($hab->getPrecio()) . '€</p>
                        </div>
                        <div class="col-md-6 col-lg-push-2">
                       
                            <div class="zona_boton">
                                                      
                                <button class="boton-seleccionar botonSel" onclick="aniadir_habitacion(\'' . $hab->getRef() . '\',\'\');">SELECCIONAR</button>
                            </div>
                        
                        </div>
                    </div>
                    <div class="row margenes fondo-blanco">
                        <div class="text-center col-md-5">
                            <p>habitacion con desayuno ' . strval($hab->getPrecio() + $hab->getPrecioDesayuno()) . '€</p>
                        </div>
                        <div class="col-md-6 col-lg-push-2">
                            
                           
                            <div class="zona_boton">                                
                                <button class="boton-seleccionar botonSel" onclick="aniadir_habitacion(\'' . $hab->getRef() . '\',\'true\');">SELECCIONAR</button>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>';
        }

        return $disponibles;
    }

    function addHab($ref, $desayuno) {
        $hab = $this->allHabitaciones[$ref];
        $tipo = $hab->getTitle();
        $img = $hab->getImg();
        $desc = "";
        $precio = 0.0;

        if(boolval($desayuno)) {
            $desc = $tipo . "<br>CON DESAYUNO";
            $precio = $hab->getPrecio() + $hab->getPrecioDesayuno();
        } else {
            $desc = $tipo . "<br>SIN DESAYUNO";
            $precio = $hab->getPrecio();
        }

        $ts1 = strtotime($this->fechaEntrada);
        $ts2 = strtotime($this->fechaSalida);
        $days = ($ts2 - $ts1) / (24 *3600);

        $precio = $precio * $days;

        if(!isset($_SESSION["habitaciones"])) {
            $_SESSION["habitaciones"] = array();
        }
        $_SESSION["habitaciones"][$_SESSION["keyHab"]] =  new Habitacion($tipo, $desc, $img, $ref, $precio);
        $_SESSION["keyHab"] = $_SESSION["keyHab"] + 1;
    }

    function removeHab($ref) {
        unset($_SESSION["habitaciones"][$ref]);
    }
 
}

$disponibles = new ReservasHabitaciones($conexion);
if(isset($_POST["add"])) {
	echo '<script>alert("hola");</script>';
    $disponibles->addHab($_POST["add"], $_POST["desayuno"]);
}
if(isset($_POST["remove"])) {
    $disponibles->removeHab($_POST["remove"]);
}
echo $disponibles->showHabs();

require './bd_desconexion.php';

 ?>