<?php

    require './PHP/bd_conexion.php';
    require './PHP/class_content.php';
    session_start();
    if(isset($_GET["logout"])) {
        session_destroy();
        session_start();
    }
    $page = $_GET["page"];

    if (is_null($page)) {
        $page = 'inicio';
    }

    echo '<!DOCTYPE html>
    <html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
        <!-- <meta name="description" content="description"/> -->
        <!-- <meta name="keywords" content="keywords"/>  -->
        <meta name="author" content="Eila Gomez"/>
        <meta name="author" content="Elias Mendez"/>
        <link rel="icon" type="./image/png" href="/images/favicon.png" />
        <link rel="stylesheet" type="text/css" href="./CSS/bootstrap.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="./CSS/inicio.css" media="screen" />
        <link rel="stylesheet" type="text/css"
        href="/CSS/' . $page . '.css" media="screen"/>
        <title>Hotel Plaza Nueva</title>
        <script src="./JS/cargar_habitaciones.js"></script>
    </head>

    <body>';

    

    include './PHP/header.php';

    include './PHP/sidebar.php';

    include './PHP/content.php';

    include './PHP/footer.php';

    if(isset($_GET["registro"])){
        echo '<script>
            alert("Se ha registrado con éxito.");
        </script>';
    }

    if(isset($_GET["reserva"])){
        echo '<script>
            alert("Se ha realizado con éxito la reserva. Para cualquier modificación o cancelación ponerse en contacto via telefónica o email. Pronto se le enviará la factura al email proporcionado.");
        </script>';
    }


    echo '</body>
    </html>';

    require './PHP/bd_desconexion.php';

?>
