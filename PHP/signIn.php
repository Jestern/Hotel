<?php
    require 'bd_conexion.php';
    session_start();
    $user = mysql_real_escape_string($_POST["user"]);
    $pass = mysql_real_escape_string($_POST["pass"]);
    $select = 'SELECT usuario FROM ClienteRegistrado WHERE usuario="' . $user. '" AND pass="' . $pass . '"';
    $result = mysql_query($select, $conexion);
    if(mysql_num_rows ($result) == 1) {
        $_SESSION["logged"] = $user;
    }
    $select = 'SELECT nombreUsuario FROM Administrador WHERE nombreUsuario="' . $user. '" AND password="' . $pass . '"';
    $result = mysql_query($select, $conexion);
    if(mysql_num_rows ($result) == 1) {
        $_SESSION["logged"] = $user;
        $_SESSION["admin"] = true;
    }
    require 'bd_desconexion.php';
    header('Location: ../index.php');
?>
