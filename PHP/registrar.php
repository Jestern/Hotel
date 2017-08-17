<?php
require 'bd_conexion.php';

session_start();

$usuario = mysql_real_escape_string($_POST["usuario"]);
$nombre = mysql_real_escape_string($_POST["nombre"]);
$apellidos = mysql_real_escape_string($_POST["apellidos"]);
$telefono = mysql_real_escape_string($_POST["telefono"]);
$email = mysql_real_escape_string($_POST["email"]);
$direccion = mysql_real_escape_string($_POST["direccion"]);
$pass_registro = mysql_real_escape_string($_POST["pass_registro"]);
$id = mysql_real_escape_string($_POST["id"]);



$select = 'SELECT usuario FROM ClienteRegistrado WHERE usuario="' . $usuario. '"';
    $result = mysql_query($select, $conexion);

$select = 'SELECT nombreUsuario FROM Administrador WHERE nombreUsuario="' . $usuario. '"';
    $result_admin = mysql_query($select, $conexion);

$select_id = 'SELECT usuario FROM ClienteRegistrado WHERE identificacion="' . $id. '"';
    $result_id = mysql_query($select_id, $conexion);

    $bool_id = mysql_num_rows ($result_id) == 1;
    $bool_user = mysql_num_rows ($result) == 1;
    $bool_admin = mysql_num_rows ($result_admin) == 1;


    if($bool_user || $bool_id || $bool_admin){

        if($bool_user || $bool_admin)
            $_SESSION['error_usuario'] = "Este nombre de usuario ya existe";
        if($bool_id)
            $_SESSION['error_id'] = "Ya hay un usuario con esta identificacion registrado";

        $_SESSION['usuario_registro'] = $usuario;
        $_SESSION['nombre_registro'] = $nombre;
        $_SESSION['apellidos_registro'] = $apellidos;
        $_SESSION['telefono_registro'] = $telefono;
        $_SESSION['email_registro'] = $email;
        $_SESSION['direccion_registro'] = $direccion;
        $_SESSION['id_registro'] = $id;
        require 'bd_desconexion.php';
        header('Location: ../index.php?page=registro');

    }else{

        $insert = "INSERT INTO Cliente (nombre, apellidos, identificacion, email, numeroTlf, hotel, direccion) VALUES ('". $nombre . "','" . $apellidos . "','" .  $id ."' ,'". $email . "','" . $telefono . "', 'HOTEL PLAZA NUEVA','". $direccion . "')";
        $result = mysql_query($insert, $conexion);
         echo $result;

        $insert = "INSERT INTO ClienteRegistrado(usuario, pass, identificacion)  VALUES ('" . $usuario . "','" . $pass_registro . "','" . $id . "')";
        mysql_query($insert, $conexion);


        require 'bd_desconexion.php';
        header('Location: ../index.php?registro=true');
    }

?>
