<?php

/**
 *
 */

class ObjetoSeccion
{

    function __construct($titulo, $desc, $img)
    {
        $this->title = $titulo;
        $this->desc = $desc;
        $this->img = $img;
    }

    function getTitle() {
        return $this->title;
    }

    function getDesc() {
        return $this->desc;
    }

    function getImg() {
        return $this->img;
    }
}

/**
 *
 */
class Habitacion extends ObjetoSeccion
{

    function __construct($titulo, $desc, $img, $ref, $precio, $precioDesayuno, $precioEspecial, $cantidad, $ocupadas, $pax)
    {
        parent::__construct($titulo, $desc, $img);
        $this->ref = $ref;
        $this->precio = $precio;
        $this->precioDesayuno = $precioDesayuno;
        $this->precioEspecial = $precioEspecial;
        $this->cantidad = $cantidad;
        $this->ocupadas = $ocupadas;
        $this->pax = $pax;
    }

    function getRef() {
        return $this->ref;
    }

    function getPrecio() {
        return $this->precio;
    }

    function getPrecioDesayuno() {
        return $this->precioDesayuno;
    }

    function getPrecioEspecial() {
        return $this->precioEspecial;
    }

    function getCantidad() {
        return $this->cantidad;
    }

    function getOcupadas() {
        return $this->ocupadas;
    }

    function getPax() {
        return $this->pax;
    }

    function setOcupadas($ocupadas) {
        $this->ocupadas = $ocupadas;
    }
}

class Service {
    function __construct($img, $caption) {
        $this->img = $img;
        $this->caption = $caption;
    }

    function getImg() {
        return $this->img;
    }

    function getCaption() {
        return $this->caption;
    }
}

class ContentInicio
{

    function __construct($conexion)
    {

        $this->imgs = array();

        // Ejecutamos una consulta
        $seleccion = 'SELECT * FROM Pagina p, Inicio i WHERE p.tituloPagina="HOTEL PLAZA NUEVA" and i.tituloPagina=p.tituloPagina';
        $resultado = mysql_query ($seleccion, $conexion);
        // Averiguamos cuántas filas ha devuelto la consulta
        if (!$resultado) {
            $mensaje  = 'Consulta no válida: ' . mysql_error() . "\n";
            $mensaje .= 'Consulta completa: ' . $seleccion;
            die($mensaje);
        }
        $numFilas = mysql_num_rows ($resultado);
        // Si la consulta ha devuelto filas, las procesamos
        if ($numFilas == 1) {

          $fila = mysql_fetch_assoc ($resultado);
          $this->title = $fila["tituloPagina"];
          $this->subtitle = $fila["subTitulo"];
          $this->service = $fila["serv"];
          $this->text = $fila["descripcion"];
          $this->desc_serv = $fila["servDescripcion"];

        }

        $seleccion = 'SELECT * FROM Servicio s, Imagen i WHERE s.idImagen = i.idImagen';
        $resultado = mysql_query ($seleccion, $conexion);
        // Averiguamos cuántas filas ha devuelto la consulta
        if (!$resultado) {
            $mensaje  = 'Consulta no válida: ' . mysql_error() . "\n";
            $mensaje .= 'Consulta completa: ' . $seleccion;
            die($mensaje);
        }
        $numFilas = mysql_num_rows ($resultado);
        // Si la consulta ha devuelto filas, las procesamos
        if ($numFilas > 0) {
            $this->t_services = array();
            while($fila = mysql_fetch_assoc ($resultado)){
                array_push($this->t_services, new Service($fila["path"], $fila["nombreServicio"]));
            }

        }

        $seleccion = 'SELECT * FROM Imagen i, ImagenesInicio inicio WHERE inicio.idImagen = i.idImagen';
        $resultado = mysql_query ($seleccion, $conexion);
        // Averiguamos cuántas filas ha devuelto la consulta
        if (!$resultado) {
            $mensaje  = 'Consulta no válida: ' . mysql_error() . "\n";
            $mensaje .= 'Consulta completa: ' . $seleccion;
            die($mensaje);
        }
        $numFilas = mysql_num_rows ($resultado);
        // Si la consulta ha devuelto filas, las procesamos
        if ($numFilas > 0) {
            $this->t_services = array();
            while($fila = mysql_fetch_assoc ($resultado)){
                array_push($this->imgs, $fila[path]);
            }

        }




    }

    function showContent() {
        echo '<section>
            <h2>' . $this->title . '</h2>
            <div class="text">
                <p>
                    <span class="resaltar">' . $this->subtitle . '</span>
                    ' . $this->text . '
                    <h3>' . $this->service . '</h3>'
                    . $this->desc_serv .
                    '<br><br> <div id="services">';

    foreach ($this->t_services as $item) {
        echo '<figure> <img src="' . $item->getImg() . '">
              <figcaption>' . $item->getCaption() . '</figcaption> </figure>';
    }

                    echo '</div></p>
                </div>

                <div class="imagenes">';

                        foreach ($this->imgs as $img) {
                            echo'<img src="' . $img . '">';
                        }

                echo ' </div>

            </div>
        </section>';
    }

}

/**
 *
 */
class ContentHabitaciones
{

    function __construct($conexion)
    {
        // Ejecutamos una consulta
        $seleccion = 'SELECT * FROM Pagina p WHERE p.tituloPagina="HABITACIONES"';
        $resultado = mysql_query ($seleccion, $conexion);
        // Averiguamos cuántas filas ha devuelto la consulta
        if (!$resultado) {
            $mensaje  = 'Consulta no válida: ' . mysql_error() . "\n";
            $mensaje .= 'Consulta completa: ' . $seleccion;
            die($mensaje);
        }
        $numFilas = mysql_num_rows ($resultado);
        // Si la consulta ha devuelto filas, las procesamos
        if ($numFilas == 1) {

          $fila = mysql_fetch_assoc ($resultado);
          $this->introduccion = $fila["descripcion"];

        }

        $seleccion = 'SELECT * FROM Habitacion h, Imagen i WHERE h.idImagen = i.idImagen ORDER BY h.cantidad DESC';
        $resultado = mysql_query ($seleccion, $conexion);
        // Averiguamos cuántas filas ha devuelto la consulta
        if (!$resultado) {
            $mensaje  = 'Consulta no válida: ' . mysql_error() . "\n";
            $mensaje .= 'Consulta completa: ' . $seleccion;
            die($mensaje);
        }
        $numFilas = mysql_num_rows ($resultado);
        // Si la consulta ha devuelto filas, las procesamos
        if ($numFilas > 0) {
            $this->habitaciones = array();
            while($fila = mysql_fetch_assoc ($resultado)){
                array_push($this->habitaciones, new Habitacion($fila["tipo"], str_replace("$1",$fila["precio"] . $fila["divisa"],$fila["descripcionHabitacion"]), $fila["path"], $fila["ref"]));
            }

        }

    }

    function showContent() {
        echo '<section>
            <p id="b_habitaciones">' . $this->introduccion . '</p>';

        foreach ($this->habitaciones as $item) {
            echo '<a name="' . $item->getRef() . '"></a>
                <div class="habitaciones">
                    <p>
                        <h3>' . $item->getTitle() . '</h3>
                        <div class="divider"></div>
                        <img src="' . $item->getImg() . '">'
                        . $item->getDesc() .
                        '</p>
                </div>';
        }

        echo '</section>';
    }
}


class Actividad extends ObjetoSeccion
{

    function __construct($title, $desc, $imgs, $video, $ref)
    {
        parent::__construct($title, $desc, $imgs);
        $this->video = $video;
        $this->ref = $ref;
        $this->button = 'Ver Video';
    }

    function getVideo() {
        return $this->video;
    }

    function getRef() {
        return $this->ref;
    }

    function getTextButton() {
        return $this->button;
    }
}

class ContentActividades
{
    function __construct($conexion)
    {

        $seleccion = 'SELECT * FROM Actividad ORDER BY nombreActividad DESC';
        $resultado = mysql_query ($seleccion, $conexion);
        // Averiguamos cuántas filas ha devuelto la consulta
        if (!$resultado) {
            $mensaje  = 'Consulta no válida: ' . mysql_error() . "\n";
            $mensaje .= 'Consulta completa: ' . $seleccion;
            die($mensaje);
        }
        $numFilas = mysql_num_rows ($resultado);

        // Si la consulta ha devuelto filas, las procesamos,
        if($numFilas > 0){
            $this->t_actividades = array();
            while($fila = mysql_fetch_assoc ($resultado)){
                $selec = 'SELECT * FROM Imagen i, ImagenesActividad a WHERE i.idImagen=a.idImagen and a.nombreActividad="' . $fila["nombreActividad"] . '"';
                $result = mysql_query ($selec, $conexion);
                $fotos = array();
                while($f = mysql_fetch_assoc ($result)){
                    array_push($fotos, $f["path"]);
                }

                array_push($this->t_actividades, new Actividad($fila["nombreActividad"],
                  str_replace("$1",$fila["precio"] . $fila["divisa"],$fila["descripcion"]), $fotos, $fila["video"], $fila["ref"]));
            }

        }


    }

    function showContent() {
        echo '<section>';

        foreach ($this->t_actividades as $act) {
            echo '<div class="actividades">
                <a name="' . $act->getRef() . '"></a>
                    <p>
                    <h3>' . $act->getTitle() . '</h3>
                    <div class="divider"></div>
                    ' . $act->getDesc() . '
                    <div class="divider2"></div>
                    <div class="center">';
            $imgs = $act->getImg();
            foreach ($imgs as $img) {
                echo '<img src="' . $img . '">';
            }

            echo '</div>
            <div class="zona_boton">
                <a href="' . $act->getVideo() . '"
                alt="Youtube" target="_blank">
                <button class="boton">' . $act->getTextButton() . '</button>
                        </a>
                    </div>
                    </p>
            </div>';
        }

        echo '</section>';
    }
}

class ContentLocalizacion
{
    function __construct($conexion)
    {
        $seleccion = 'SELECT * FROM Pagina WHERE tituloPagina = "LOCALIZACION"';
        $resultado = mysql_query ($seleccion, $conexion);
        // Averiguamos cuántas filas ha devuelto la consulta
        if (!$resultado) {
            $mensaje  = 'Consulta no válida: ' . mysql_error() . "\n";
            $mensaje .= 'Consulta completa: ' . $seleccion;
            die($mensaje);
        }
        $numFilas = mysql_num_rows ($resultado);

        // Si la consulta ha devuelto filas, las procesamos,
        if($numFilas > 0){
          $fila = mysql_fetch_assoc ($resultado);
          $this->content = '<section>'. $fila["descripcion"].'</section>';
        }
    }

    function showContent() {
        echo $this->content;
    }
}

class Formulario
{
    function __construct($conexion)
    {
        $seleccion = 'SELECT * FROM Formulario';
        $resultado = mysql_query ($seleccion, $conexion);
        // Averiguamos cuántas filas ha devuelto la consulta
        if (!$resultado) {
            $mensaje  = 'Consulta no válida: ' . mysql_error() . "\n";
            $mensaje .= 'Consulta completa: ' . $seleccion;
            die($mensaje);
        }
        $numFilas = mysql_num_rows ($resultado);

        // Si la consulta ha devuelto filas, las procesamos,
        if($numFilas > 0){
          $fila = mysql_fetch_assoc ($resultado);
          $this->name = $fila["nombreApellidos"];
          $this->phone = $fila["tlf"];
          $this->email = $fila["email"];
          $this->text = $fila["msg"];
          $this->must = $fila["camposObligatorios"];
          $this->send = $fila["txtBoton"];
        }


    }

    function getTextName() {
        return $this->name;
    }

    function getTextPhone() {
        return $this->phone;
    }

    function getTextEmail() {
        return $this->email;
    }

    function getTextText() {
        return $this->text;
    }

    function getTextSend() {
        return $this->send;
    }

    function getTextMust() {
        return $this->must;
    }
}


class ContentContacto
{

    function __construct($conexion)
    {
        $seleccion = 'SELECT * FROM Pagina WHERE tituloPagina = "FORMULARIO DE CONTACTO"';
        $resultado = mysql_query ($seleccion, $conexion);
        // Averiguamos cuántas filas ha devuelto la consulta
        if (!$resultado) {
            $mensaje  = 'Consulta no válida: ' . mysql_error() . "\n";
            $mensaje .= 'Consulta completa: ' . $seleccion;
            die($mensaje);
        }
        $numFilas = mysql_num_rows ($resultado);

        // Si la consulta ha devuelto filas, las procesamos,
        if($numFilas > 0){
          $fila = mysql_fetch_assoc ($resultado);
          $this->title = $fila["tituloPagina"];
          $this->text = $fila["descripcion"];
          $this->form = new FORMULARIO($conexion);
        }

    }

    function showContent() {
        $content = '<section>
            <h2>' . $this->title . '</h2>
            <p>' . $this->text . '</p>
            <form onsubmit="return enviarFormulario();" action="/PHP/send.php" method="post">
              <label for="nombre">' . $this->form->getTextName() . '</label>
              <span class="error" id="s_nombre"></span>
              <input name="nombre" id="nombre" type="text"></input>

              <label for="telefono">' . $this->form->getTextPhone() . '</label>
              <span class="error" id="s_telefono"></span>
              <input name="telefono" id="telefono" type="text"></input>

              <label for="email">' . $this->form->getTextEmail() . '</label>
              <span class="error" id="s_email"></span>
              <input name="email" id="email" type="text"></input>

              <label for="mensaje">' . $this->form->getTextText() . '</label>
              <span class="error" id="s_mensaje"></span>
              <textarea name="mensaje" id="mensaje"></textarea>
              <p>' . $this->form->getTextMust() . '</p>

              <input type="submit" value="' . $this->form->getTextSend() . '">
            </form>
        </section>';

        echo $content;
    }
}

class FormularioRegistro
{
    function __construct($conexion)
    {
        $seleccion = 'SELECT * FROM FormularioRegistro';
        $resultado = mysql_query ($seleccion, $conexion);
        // Averiguamos cuántas filas ha devuelto la consulta
        if (!$resultado) {
            $mensaje  = 'Consulta no válida: ' . mysql_error() . "\n";
            $mensaje .= 'Consulta completa: ' . $seleccion;
            die($mensaje);
        }
        $numFilas = mysql_num_rows ($resultado);

        // Si la consulta ha devuelto filas, las procesamos,
        if($numFilas > 0){
            $fila = mysql_fetch_assoc ($resultado);
            $this->user = $fila["Usuario"];;
            $this->surname = $fila["Apellidos"];
            $this->name = $fila["Nombre"];
            $this->phone = $fila["Tlf"];
            $this->dir = $fila["Direccion"];
            $this->id = $fila["Identificacion"];
            $this->email = $fila["Email"];
            $this->pass = $fila["Contrasenia"];
            $this->rep_pass = $fila["ContraseniaRep"];
            $this->must = $fila["camposObligatorios"];
            $this->send = $fila["Boton"];
        }


    }

    function getTextName() {
        return $this->name;
    }

    function getTextDir() {
        return $this->dir;
    }

    function getTextId() {
        return $this->id;
    }

    function getTextUser() {
        return $this->user;
    }

    function getTextSurname() {
        return $this->surname;
    }

    function getTextPhone() {
        return $this->phone;
    }

    function getTextEmail() {
        return $this->email;
    }

    function getTextPass() {
        return $this->pass;
    }

    function getTextRep_pass() {
        return $this->rep_pass;
    }

    function getTextMust() {
        return $this->must;
    }

    function getTextSend() {
        return $this->send;
    }
}

class ContentRegistro
{

    function __construct($conexion)
    {
        $seleccion = 'SELECT * FROM Pagina WHERE tituloPagina="REGISTRO DE USUARIO"';
        $resultado = mysql_query ($seleccion, $conexion);
        // Averiguamos cuántas filas ha devuelto la consulta
        if (!$resultado) {
            $mensaje  = 'Consulta no válida: ' . mysql_error() . "\n";
            $mensaje .= 'Consulta completa: ' . $seleccion;
            die($mensaje);
        }
        $numFilas = mysql_num_rows ($resultado);

        // Si la consulta ha devuelto filas, las procesamos,
        if($numFilas > 0){
            $fila = mysql_fetch_assoc ($resultado);
            $this->title = $fila["tituloPagina"];
        }

        $this->form = new FormularioRegistro($conexion);
    }

    function showContent() {
        if(isset($_SESSION['usuario_registro'])){
            $usuario_registro = $_SESSION['usuario_registro'];
            $nombre_registro = $_SESSION['nombre_registro'];
            $apellidos_registro = $_SESSION['apellidos_registro'];
            $telefono_registro = $_SESSION['telefono_registro'];
            $email_registro = $_SESSION['email_registro'];
            $direccion_registro = $_SESSION['direccion_registro'];
            $id_registro = $_SESSION['id_registro'];
            $id_error = $_SESSION['error_id'];
            $user_error= $_SESSION['error_usuario'];
        }
        $content = '<section>
            <div>
                <div class="margenes imagenes">
                    <form class="text-left margenes"  onsubmit="return enviarFormularioRegistro();" action="/PHP/registrar.php" method="post">
                        <h3 class="text-center"> ' . $this->title . '</h3>
                        <div class="margenes">

                            <label>' . $this->form->getTextUser() . '
                                <input  name="usuario" id="usuario" type="text" placeholder="' . $this->form->getTextUser() . '" value="' . $usuario_registro . '" />
                            </label>
                            <span class="error" id="s_usuario">'.$user_error.'</span>
                        </div>

                        <div class="margenes">

                            <label>' . $this->form->getTextName() . '
                                <input name="nombre" id="nombre" type="text" placeholder="' . $this->form->getTextName() . '" value="' . $nombre_registro . '"  />
                            </label>
                            <span class="error" id="s_nombre"></span>
                        </div>

                        <div class="margenes">

                            <label>' . $this->form->getTextSurname() . '
                                <input name="apellidos" id="apellidos" type="text" placeholder="' . $this->form->getTextSurname() . '" value="' . $apellidos_registro . '" />
                            </label>
                            <span class="error" id="s_apellidos"></span>
                        </div>
                        <div class="margenes">

                            <label>' . $this->form->getTextPass() . '
                                <input name="pass_registro" id="pass_registro" type="password" placeholder="' . $this->form->getTextPass() . '"  />
                            </label>
                            <span class="error" id="s_pass"></span>
                        </div>
                        <div class="margenes">

                            <label>' . $this->form->getTextRep_pass() . '
                                <input name="repass_registro" id="repass_registro" type="password" placeholder="' . $this->form->getTextRep_pass() . '"  />
                            </label>
                            <span class="error" id="s_repass"></span>
                        </div>
                        <div class="margenes">

                            <label>' . $this->form->getTextDir() . '
                                <input name="direccion" id="direccion" type="text" placeholder="' . $this->form->getTextDir() . '" value="' . $direccion_registro . '" />
                            </label>
                            <span class="error" id="s_direccion"></span>
                        </div>
                        <div class="margenes">

                            <label>' . $this->form->getTextEmail() . '
                                <input name="email" id="email" type="text" placeholder="' . $this->form->getTextEmail() . '" value="' . $email_registro . '" />
                            </label>
                            <span class="error" id="s_email"></span>
                        </div>
                        <div class="margenes">

                            <label>' . $this->form->getTextId() . '
                                <input name="id" id="id" type="text" placeholder="' . $this->form->getTextId() . '" value="' . $id_registro . '" />
                            </label>
                            <span class="error" id="s_id">'.$id_error.'</span>
                        </div>
                        <div class="margenes">

                            <label>' . $this->form->getTextPhone() . '
                                <input name="telefono" id="telefono" type="tel" placeholder="' . $this->form->getTextPhone() . '" value="' . $telefono_registro . '" />
                            </label>
                            <span class="error" id="s_telefono"></span>
                        </div>
                        <p class="margenes">' . $this->form->getTextMust() . '</p>
                        <div class="text-center margenes">
                            <input type="submit" placeholder="input fiels" class="button" value="' . $this->form->getTextSend() . '">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </section>';
        if(isset($_SESSION['usuario_registro'])){
            unset($_SESSION['usuario_registro']);
            unset($_SESSION['nombre_registro']);
            unset($_SESSION['apellidos_registro']);
            unset($_SESSION['telefono_registro']);
            unset($_SESSION['email_registro']);
            unset($_SESSION['direccion_registro']);
            unset($_SESSION['id_registro']);
            unset($_SESSION['error_usuario']);
            unset($_SESSION['error_id']);
        }

        echo $content;
    }
}

class ReservaAct {
    function __construct($nombre, $precio, $img, $num, $ref) {
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->num = $num;
        $this->ref = $ref;
        $this->img = $img;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getNum() {
        return $this->num;
    }

    function getPrecio() {
        return $this->precio;
    }
    function incrementNum() {
        $this->num = $this->num + 1;
    }
    function getRef() {
        return $this->ref;
    }

    function getImg() {
        return $this->img;
    }
}

class SideReserva {
    function __construct() {
        $this->fechaEntrada = $_SESSION["fechaEntrada"];
        $this->fechaSalida = $_SESSION["fechaSalida"];
        $this->adultos = $_SESSION["adultos"];
        $this->ninios = $_SESSION["ninios"];
    }

    function echoSide() {
        $this->habs = $_SESSION["habitaciones"];
        $this->acts = $_SESSION["actividades"];
        $total = 0.0;
        echo '<div class="col-md-3 col-xs-12 col-sm-12 col-lg-3">
            <div class="row">
                <div class="side_reserva">
                    <div id="titleR">
                        Datos Reserva
                    </div>
                    <div class="divider"></div>
                    <p><span class="resaltar">Fecha de entrada: ' . date("d/m/Y", strtotime($this->fechaEntrada)) . '</span> <br><br><span class="resaltar">Fecha de salida: ' . date("d/m/Y", strtotime($this->fechaSalida)) . '</span> <br><br><span class="resaltar">Número de adultos: ' . $this->adultos . '</span> <br><br><span class="resaltar">Número de niños: ' . $this->ninios . '</span> <br><br></p>
                </div>
            </div>
            <div class="row">
                <div class="side_reserva">
                    <div id="titleR">
                        Habitaciones seleccionadas
                    </div>
                    <div class="divider"></div>
                    <div id="habitaciones_seleccionadas">';


                    foreach ($this->habs as $key => $hab) {
                        echo '<div class="row margenes hab-barra">
                            <div class="col-md-3">
                                <img src="' . $hab->getImg() . '" width="70" />
                            </div>
                            <div class="text-center col-md-7">
                                <p>' . $hab->getDesc() . '</p>
                            </div>
                            <div class="col-md-2 text-right">';
                            if($_GET["page"] === "reservar") {
                            echo '<button class="boton_x" onclick="quitar_habitacion(\'' . $key . '\');">x</button>';
                            }
                            echo '</div>
                            </div>';
                            $total += $hab->getPrecio();
                    }
                echo'
                </div>
                </div>
            </div>
            <div class="row">
                <div class="side_reserva">
                    <div id="titleR">
                        Actividades reservadas
                    </div>
                    <div class="divider"></div>
                    <div id="actividades_reservadas">';

            foreach ($this->acts as $key => $act) {
                echo '<div class="row margenes">
                <div class="col-md-8">
                    <p><span class="resaltar">'. $act->getNombre() .'</span> <br><br></p>
                </div>
                <div class="col-md-1">
                    <p><span class="resaltar">'. $act->getNum() .'</span> <br><br></p>
                </div>
                <div class="col-md-2 text-right">';
                if($_GET["page"] === "reservarActividades") {
                    echo '<button class="boton_x" onclick="quitar_actividad(\'' . $key . '\');">x</button>';
                }
                echo '</div></div>';
                $total += $act->getPrecio() * $act->getNum();
            }

                    echo'
                    </div>
                    </div>

            <div class="row">
                <div class="side_reserva">
                    <div id="titleR">
                        Total: <span id="total_reserva">' . strval($total) . '</span> €
                    </div>
                </div>
            </div>
        </div>';
    }
}

class ContentReservasHabitaciones
{

    function __construct()
    {
      
        $this->side = new SideReserva();
       
    }

    
    function showContent() {
        echo '<section>
            <div class="row">
                <div class="margenes col-xs-12 col-sm-12 col-lg-8 col-md-8">
                    <div id="habitaciones_disponibles">                  
                    
                    </div>
                    <script>cargar_disponibles();</script>
                        <div class="row margenes">
                        <div class="col-md-3">
                            <div class="zona_boton">
                                <a href="index.php"><button class="boton-seleccionar botonSel">ATRAS</button></a>
                            </div>
                        </div>
                        <div class="col-md-9 text-right">
                            <div class="zona_boton">
                                <a href="index.php?page=reservarActividades"><button class="boton-seleccionar botonSig">SIGUIENTE</button></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="resumen">                
                </div>
                <script>cargar_resumen("reservar");</script>
                </div>
        </section>';
    }
}


class Reserva
{
    function __construct($identificador, $identificacion, $nombre, $fecha, $fecha_e, $fecha_s, $habitaciones, $sierra, $alhambra, $ninios, $adultos)
    {
        $this->name = $nombre;
        $this->ninios = $ninios;
        $this->adultos = $adultos;
        $this->identificador = $identificador;
        $this->identificacion = $identificacion;
        $this->fecha = $fecha;
        $this->fecha_e = $fecha_e;
        $this->fecha_s = $fecha_s;
        $this->habitaciones = $habitaciones;
        $this->sierra = $sierra;
        $this->alhambra = $alhambra;
    }

    function getTextName() {
        return $this->name;
    }

     function getTextNinios() {
        return $this->ninios;
    }

     function getTextAdultos() {
        return $this->adultos;
    }

    function getTextIdentificador() {
        return $this->identificador;
    }

    function getTextIdentificacion() {
        return $this->identificacion;
    }

    function getTextFecha() {
        return $this->fecha;
    }
    function getTextFecha_e() {
        return $this->fecha_e;
    }
    function getTextFecha_s() {
        return $this->fecha_s;
    }

    function getTextHabitaciones() {
        return $this->habitaciones;
    }

    function getTextSierra() {
        return $this->sierra;
    }

    function getTextAlhambra() {
        return $this->alhambra;
    }


}



class ContentReservasAdmin
{

    function __construct(){ }

    function showContent() {

        echo '<section>
             <form class="resrvascontainer"> 
                Buscar: <input  type="text" placeholder="DNI o Apellido" onkeyup="mostrar_reservas(this.value)">
                </form>
                <p id="txtHint"></p>
            <div id="reservas" class="col-md-12 col-lg-12 col-sm-12">
            </div>
            <script>mostrar_reservas("");</script>
        </section>';
    }
}

class FormularioPago
{
    function __construct($conexion)
    {
        $seleccion = 'SELECT * FROM FormularioRegistro';
        $resultado = mysql_query ($seleccion, $conexion);
        // Averiguamos cuántas filas ha devuelto la consulta
        if (!$resultado) {
            $mensaje  = 'Consulta no válida: ' . mysql_error() . "\n";
            $mensaje .= 'Consulta completa: ' . $seleccion;
            die($mensaje);
        }
        $numFilas = mysql_num_rows ($resultado);

        // Si la consulta ha devuelto filas, las procesamos,
        if($numFilas > 0){
            $fila = mysql_fetch_assoc ($resultado);
            $this->surname = $fila["Apellidos"];
            $this->name = $fila["Nombre"];
            $this->phone = $fila["Tlf"];
            $this->dir = $fila["Direccion"];
            $this->id = $fila["Identificacion"];
            $this->email = $fila["Email"];
            $this->tarjeta = $fila["tarjeta"];
            $this->must = $fila["camposObligatorios"];
            $this->send = "FINALIZAR RESERVA";
            $this->atras = "ATRAS";

        }


    }

    function getTextName() {
        return $this->name;
    }

    function getTextDir() {
        return $this->dir;
    }

    function getTextId() {
        return $this->id;
    }

    function getTextSurname() {
        return $this->surname;
    }

    function getTextPhone() {
        return $this->phone;
    }

    function getTextEmail() {
        return $this->email;
    }

    function getTextTarjeta() {
        return $this->tarjeta;
    }

    function getTextMust() {
        return $this->must;
    }

    function getTextSend() {
        return $this->send;
    }

    function getTextAtras() {
        return $this->atras;
    }
}

class ContentReservasActividades {
    function __construct($conexion)
    {
        $this->actividades = array();
        $seleccion = 'SELECT * FROM Actividad a, ImagenesActividad ia, Imagen i WHERE a.nombreActividad=ia.nombreActividad AND (ia.idImagen="sierra1" OR ia.idImagen="al1") AND ia.idImagen=i.idImagen ORDER BY a.nombreActividad DESC';
        $resultado = mysql_query ($seleccion, $conexion);
        // Averiguamos cuántas filas ha devuelto la consulta
        if (!$resultado) {
            $mensaje  = 'Consulta no válida: ' . mysql_error() . "\n";
            $mensaje .= 'Consulta completa: ' . $seleccion;
            die($mensaje);
        }
        $numFilas = mysql_num_rows ($resultado);

        // Si la consulta ha devuelto filas, las procesamos,
        if($numFilas > 0){
            while($fila = mysql_fetch_assoc ($resultado)){
                $this->actividades[$fila["ref"]] =  new ReservaAct($fila["nombreActividad"], $fila["precio"], $fila["path"], 1, $fila["ref"]);
            }
        }
    }
    function addActividad($ref) {
        if(isset($_SESSION["actividades"][$ref])) {
            $_SESSION["actividades"][$ref]->incrementNum();
        } else {
            $_SESSION["actividades"][$ref] = new ReservaAct($this->actividades[$ref]->getNombre(), $this->actividades[$ref]->getPrecio(), $this->actividades[$ref]->getImg(), 1, $this->actividades[$ref]->getRef());
        }
    }

    function removeActividad($ref) {
        unset($_SESSION["actividades"][$ref]);
    }

    function showContent() {
        $side = new SideReserva();
        echo '<section>
            <div class="row">
                <div class="col-md-8 margenes">
                    <h3 class="text-center">Añada a su reserva algunas actividades si lo desea</h3>';

        foreach ($this->actividades as $key => $act) {
            echo '<div class="row reservaHab margenes text-center">
                <h3>' . $act->getNombre() . '</h3>
                <img src="' . $act->getImg() . '" width="170" />
                <div class="text-center">
                    <a href="index.php?page=actividades#' . $act->getRef() . '" target="_blank">Más detalles</a>
                </div>
                <p>Precio por persona: ' . $act->getPrecio() . '€</p>                
                    <button class="boton-seleccionar botonSel" onclick="aniadir_actividad(\'' . $act->getRef() . '\');">AÑADIR (PARA UNA PERSONA)</button>
               
                </div>';
        }

                    echo '<div class="row margenes">
                        <div class="col-md-3">
                            <div class="zona_boton">
                                <a href="index.php?page=reservar"><button class="boton-seleccionar botonSel">ATRAS</button></a>
                            </div>
                        </div>
                        <div class="col-md-9 text-right">
                            <div class="zona_boton">
                                <a href="index.php?page=reservarPago"><button class="boton-seleccionar botonSig">SIGUIENTE</button></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="resumen">                
                </div>
                <script>cargar_resumen("reservarActividades");</script>
            </div>
        </section>';
    }
}

class ContentPago{

    function __construct($conexion)
    {
        $seleccion = 'SELECT * FROM Pagina WHERE tituloPagina="DATOS DE PAGO"';
        $resultado = mysql_query ($seleccion, $conexion);
        $this->conexion = $conexion;
        // Averiguamos cuántas filas ha devuelto la consulta
        if (!$resultado) {
            $mensaje  = 'Consulta no válida: ' . mysql_error() . "\n";
            $mensaje .= 'Consulta completa: ' . $seleccion;
            die($mensaje);
        }
        $numFilas = mysql_num_rows ($resultado);

        // Si la consulta ha devuelto filas, las procesamos,
        if($numFilas > 0){
            $fila = mysql_fetch_assoc ($resultado);
            $this->title = $fila["tituloPagina"];
            $this->descripcion = $fila["descripcion"];
        }

        $this->form = new FormularioPago($conexion);
        $this->side = new SideReserva();

    }

    function showContent() {

        if(isset($_SESSION['logged'])){

            $seleccion = 'SELECT * FROM Cliente c, ClienteRegistrado r WHERE r.identificacion=c.identificacion AND r.usuario="' . $_SESSION['logged'] .'"';
            $resultado = mysql_query ($seleccion, $this->conexion);
            // Averiguamos cuántas filas ha devuelto la consulta
            if (!$resultado) {
                $mensaje  = 'Consulta no válida: ' . mysql_error() . "\n";
                $mensaje .= 'Consulta completa: ' . $seleccion;
                die($mensaje);
            }
            $numFilas = mysql_num_rows ($resultado);

            // Si la consulta ha devuelto filas, las procesamos,
            if($numFilas > 0){
                $fila = mysql_fetch_assoc ($resultado);
                $nombre_pago = $fila['nombre'];
                $apellidos_pago = $fila['apellidos'];
                $telefono_pago = $fila['numeroTlf'];
                $email_pago = $fila['email'];
                $direccion_pago = $fila['direccion'];
                $id_pago = $fila['identificacion'];

            }


        }



        echo '<section>
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="row">
                    <div class="col-md-8 margenes">
                    <h3 class="text-center">'. $this->descripcion .'</h3>
                    <div class="row reservaHab margenes text-center">
                        <form class="text-left margenes" data-abide="" onsubmit="return enviarFormularioPago();" action="./PHP/reservaPago.php" method="post">
                            <h4 class="text-center">' . $this->title . '</h4>
                            <div class="margenes">
                                <label> ' . $this->form->getTextName() . '
                                    <input name="nombre" id="nombre" type="text" placeholder="' . $this->form->getTextName() . '" value=" '.$nombre_pago.' " />
                                </label>
                            </div>
                            <span class="error" id="s_nombre"></span>
                            <div class="margenes">
                                <label>' . $this->form->getTextSurname() . '
                                    <input name="apellidos" id="apellidos" type="text" placeholder="' . $this->form->getTextSurname() . '" value="'.$apellidos_pago.'" />
                                </label>
                            </div>
                            <span class="error" id="s_apellidos"></span>
                            <div class="margenes">
                                <label>' . $this->form->getTextEmail() . '
                                    <input name="email" id="email" type="email" placeholder="' . $this->form->getTextEmail() . '" value="'.$email_pago.'" />
                                </label>
                            </div>
                            <span class="error" id="s_email"></span>
                            <div class="margenes">
                                <label>' . $this->form->getTextDir() . '
                                    <input name="direccion" id="direccion" type="text" placeholder="' . $this->form->getTextDir() . '" value="'.$direccion_pago.'" />
                                </label>
                            </div>
                            <span class="error" id="s_direccion"></span>
                            <div class="margenes">
                                <label>' . $this->form->getTextId() . '
                                    <input name="id" id="id" type="text" placeholder="' . $this->form->getTextId() . '" value="'.$id_pago.'" />
                                </label>
                            </div>
                            <span class="error" id="s_id"></span>
                            <div class="margenes">
                                <label>' . $this->form->getTextPhone() . '
                                    <input name="telefono" id="telefono" type="tel" placeholder="' . $this->form->getTextPhone() . '" value="'.$telefono_pago.'" />
                                </label>
                            </div>
                            <span class="error" id="s_telefono"></span>
                            <div class="margenes">
                                <label>' . $this->form->getTextTarjeta() . '
                                    <input name="tarjeta" id="tarjeta" type="tel" placeholder="' . $this->form->getTextTarjeta() . '" />
                                </label>
                            </div>
                            <span class="error" id="s_tarjeta"></span>
                            <p>' . $this->form->getTextMust() . '</p>
                            <div class="text-center margenes"></div>

                            <div class="row margenes">
                                <div class="col-md-3">
                                    <div class="zona_boton">
                                        <a href="index.php?page=reservarActividades"<button class="boton-seleccionar botonSel">' . $this->form->getTextAtras() . '</button></a>
                                    </div>
                                </div>
                                <div class="col-md-9 text-right">
                                    <div>
                                        <input id="finalizar" type="submit" placeholder="input fiels" value="' . $this->form->getTextSend() . '">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>';
            $this->side->echoSide();
            echo '</div>
        </section>';


    }
}



?>
