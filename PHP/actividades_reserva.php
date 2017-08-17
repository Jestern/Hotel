<?php 
/*
ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE);
*/
require './bd_conexion.php';
require './class_content.php';
session_start();

 $content = new ContentReservasActividades($conexion);

if(isset($_POST["add"])) {
    $content->addActividad($_POST["add"]);
}
if(isset($_POST["remove"])) {
    $content->removeActividad($_POST["remove"]);
}

require './bd_desconexion.php';

 ?>