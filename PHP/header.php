<?php

require './PHP/class_header.php';


$inicio = $habitaciones = $actividades = $loc = $contacto = "";

switch ($page) {
    case 'habitaciones':
        $habitaciones = 'id="selected"';
        break;

    case 'actividades':
        $actividades = 'id="selected"';
        break;

    case 'localizacion':
        $loc = 'id="selected"';
        break;

    case 'contacto':
        $contacto = 'id="selected"';
        break;

    default:
        $inicio = 'id="selected"';
        break;
}

$menu = new Menu($conexion);


$select = 'SELECT * FROM Cabecera WHERE hotel="HOTEL PLAZA NUEVA"';
$result = mysql_query($select, $conexion);
if(mysql_num_rows ($result) == 1) {
    $fila = mysql_fetch_assoc ($result);
    $title = $fila["tituloCabecera"];
    $inicioSesion = $fila["inicioSesion"];
    $registrarse = $fila["registrarse"];
    $usuario = $fila["usuario"];
    $contrasenia = $fila["contrasenia"];
    $msgIniciado = $fila["msgIniciado"];

}

echo '<header>
<div class="barra_superior text-left">';
if(isset($_SESSION['logged'])) {
    $top = '<p>' . str_replace("$1", $_SESSION['logged'], $msgIniciado) . ' | <a href="index.php?logout=true">Cerrar Sesión</a>';
    if(isset($_SESSION["admin"])) {
        $top = $top . ' | <a href="index.php?page=reservas">Ver Reservas</a></p>';
    } else
        $top = $top . '</p>';
    echo $top;

} else {
    echo '<span class="dropdown_login"><a class="margenes">' . $inicioSesion . '</a><div class="dropdown-content">
            <form role="form" class="margenes" method="post" action="./PHP/signIn.php">
                <div class="form-group">
                    <label class="control-label" for="exampleInputEmail1">' . $usuario . '</label>
                    <input name="user" type="text" class="form-control" id="user" placeholder="' . $usuario . '">
                </div>
                <div class="form-group">
                    <label class="control-label" for="exampleInputPassword1">' . $contrasenia . '</label>
                    <input name="pass" type="password" class="form-control" id="pass" placeholder="' . $contrasenia . '">
                </div>
                <input type="submit" placeholder="input fiels" class="button" value="' . $inicioSesion . '">
            </form>
        </div></span>
    |
    <a href="index.php?page=registro" class="margenes">' . $registrarse . '</a>';
}
 echo '</div>
    <div class="title">
        <h1><a href="index.php">' . $title . '</a></h1>
        <p>&#9733 &#9733 &#9733</p>
    </div>
</header>

<nav>
    <div class="navigation">
        <a href="'. $menu->getInicio()->getLink() . '" ' . $inicio . '>' . $menu->getInicio()->getName() . '</a>
        <span class="dropdown">
            <a href="'. $menu->getHab()->getLink() . '" ' . $habitaciones . '>' . $menu->getHab()->getName() . '</a>
            <div class="dropdown-content">';

$items = $menu->getHabs();
foreach ($items as $item) {
    echo '<a href="' . $item->getLink() . '">' . $item->getName() . '</a>';
}
            echo '</div>
        </span>
        <span class="dropdown">
            <a href="'. $menu->getAct()->getLink() . '" ' . $actividades . '>' . $menu->getAct()->getName() . '</a>
            <div class="dropdown-content">';

$items = $menu->getActs();
foreach ($items as $item) {
    echo '<a href="' . $item->getLink() . '">' . $item->getName() . '</a>';
}

            echo '</div>
        </span>
        <a href="'. $menu->getLoc()->getLink() . '" ' . $loc . '>' . $menu->getLoc()->getName() . '</a>
        <a href="'. $menu->getCont()->getLink() . '" ' . $contacto . '>' . $menu->getCont()->getName() . '</a>
    </div>
</nav>';

?>
