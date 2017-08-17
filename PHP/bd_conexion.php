<?php
	
	$servidor_bd = "localhost";
	$usuario_bd = "sibw";
	$clave_bd = "sibw";
	$bd = "sibw";
	$conexion = mysql_connect ($servidor_bd, $usuario_bd, $clave_bd) or exit('No se pudo conectar con el servidor');
	mysql_set_charset('utf8', $conexion);
	$abreBD = mysql_select_db ($bd, $conexion);
	if (!$abreBD) {
		die('No se pudo abrir la base de datos.Error: ' .
		mysql_error());
	}



?>
