<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE);
require './class_content.php';
session_start();

$disponibles = new SideReserva();
$disponibles->echoSide();

?>