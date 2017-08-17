<?php

$content;

switch ($page) {
    case 'inicio':
        $content = new ContentInicio($conexion);
        break;

    case 'habitaciones':
        $content = new ContentHabitaciones($conexion);
        break;

    case 'actividades':
        $content = new ContentActividades($conexion);
        break;

    case 'localizacion':
        $content = new ContentLocalizacion($conexion);
        break;

    case 'contacto':
        $content = new ContentContacto($conexion);
        break;
    case 'registro':
        $content = new ContentRegistro($conexion);
        break;
    case 'reservar':
        if(!isset($_POST["fechaEntrada"]) and !isset($_SESSION["fechaEntrada"])) {
            header('Location: ../index.php');
        }
        if(isset($_POST["fechaEntrada"])) {
            $_SESSION["habitaciones"] = array();
            $_SESSION["actividades"] = array();
            $_SESSION["keyHab"] = 0;
            $_SESSION["fechaEntrada"] = $_POST["fechaEntrada"];
            $_SESSION["fechaSalida"] = $_POST["fechaSalida"];
            $_SESSION["adultos"] = $_POST["adultos"];
            $_SESSION["ninios"] = $_POST["ninios"];
        }
        $content = new ContentReservasHabitaciones();
        
        break;
    case 'reservarActividades':
        if(!isset($_SESSION["habitaciones"])) {
            header('Location: ../index.php');
        }
        $content = new ContentReservasActividades($conexion);
        
        break;

        case 'reservarPago':
            if(!isset($_SESSION["habitaciones"])) {
                header('Location: ../index.php');
            }
            $content = new ContentPago($conexion);
            break;

    case 'reservas':
        if(!isset($_SESSION["admin"])) {
            header('Location: ../index.php');
        }
        $content = new ContentReservasAdmin();
        break;

    default:
        $content = new ContentInicio($conexion);
        break;
}

$content->showContent();

?>
