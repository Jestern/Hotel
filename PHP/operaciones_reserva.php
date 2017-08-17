<?php

require 'bd_conexion.php';

session_start();


if (isset($_POST["cancelar"])) {
    $update = 'UPDATE Reserva SET estado="Cancelada" WHERE identificador="' . $_POST["cancelar"]. '"';
    $result = mysql_query($update, $conexion);

}else if (isset($_POST["confirmar"])) {
    $update = 'UPDATE Reserva SET estado="Confirmada" WHERE identificador="' . $_POST["confirmar"]. '"';
    $result = mysql_query($update, $conexion);

}



require 'bd_desconexion.php';
header('Location: ../index.php?page=reservas');
    

?>
