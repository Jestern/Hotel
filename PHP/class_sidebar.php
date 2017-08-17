<?php

class Promocion
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

class ContentSide
{

    function __construct($conexion)
    {
        $select = 'SELECT * FROM AsideContacto a, Contacto c WHERE a.idioma="es" AND a.idioma=c.idioma';
        $result = mysql_query($select, $conexion);
        if(mysql_num_rows ($result) > 0) {
            $fila = mysql_fetch_assoc ($result);
            $this->title = $fila["menu"];
            $this->contact = $fila["contacto"];
            $this->address = $fila["dir"];
            $this->phone = $fila["tlf"];
            $this->promotions = $fila["promociones"];

        }

        $select = 'SELECT * FROM Hotel WHERE hotel="HOTEL PLAZA NUEVA"';
        $result = mysql_query($select, $conexion);
        if(mysql_num_rows ($result) > 0) {
            $fila = mysql_fetch_assoc ($result);
            $this->location = $fila["direccion"];
            $this->phone_number = $fila["numeroTel"];
            $this->fax = $fila["numeroFax"];
            $this->email = $fila["correo"];

        }

        $select = 'SELECT * FROM FormularioReserva WHERE hotel="HOTEL PLAZA NUEVA"';
        $result = mysql_query($select, $conexion);
        if(mysql_num_rows ($result) > 0) {
            $fila = mysql_fetch_assoc ($result);
            $this->tituloReserva = $fila["tituloReserva"];
            $this->fechaEntrada = $fila["fechaEntrada"];
            $this->fechaSalida = $fila["fechaSalida"];
            $this->adultos = $fila["adultos"];
            $this->nAdultos = $fila["nAdultos"];
            $this->ninios = $fila["ninios"];
            $this->nNinios = $fila["nNinios"];
            $this->botonBuscar = $fila["botonBuscar"];

        }

        $this->context_menu = new Menu($conexion);


        $select = 'SELECT * FROM Promocion p, Imagen i WHERE p.idImagen=i.idImagen ORDER BY p.idImagen ASC';
        $result = mysql_query($select, $conexion);

        $this->t_promotions = array();
        while($fila = mysql_fetch_assoc ($result)) {
            array_push($this->t_promotions, new Promocion($fila["nombrePromocion"], $fila["descripcionPromocion"], $fila["path"]));
        }
    }

    function showContent($page) {
        echo '<aside>
            <div class="promocontainer zona_reserva">
                <div id="titleR">' . $this->tituloReserva . '</div>
                <div class="divider"></div>
                <form data-abide="h5e5uo-abide" class="formulario" method="post" onsubmit="return enviarBuscarReserva();" action="index.php?page=reservar">
                    <label>' . $this->fechaEntrada . '
                        <small></small>
                        <input name="fechaEntrada" id="fechaEntrada" type="date" placeholder="input fiels" value="&quot;&quot;" pattern="date" required="" min="' . date('Y-m-d') . '" >
                    </label>
                    <label>' . $this->fechaSalida . '
                        <input name="fechaSalida" id="fechaSalida" type="date" placeholder="input fiels" pattern="date" required="" min="' . date('Y-m-d',strtotime(date('Y-m-d') . "+1 days")) . '">
                    </label>
                    <span class="error" id="s_fechas"></span>
                    <div class="row">
                        <div class="col-lg-12">
                            <label>' . $this->adultos . '</label>
                        </div>
                        <div class="col-md-4">
                            <select name="adultos">';
                for ($i=1; $i <= $this->nAdultos; $i++) {
                    echo '<option value="' . $i .'">' . $i .'</option>';
                }
                            echo '</select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label>' . $this->ninios . '*</label>
                        </div>
                        <div class="col-md-4">
                            <select name="ninios">';
                for ($i=0; $i <= $this->nNinios; $i++) {
                    echo '<option value="' . $i .'">' . $i .'</option>';
                }
                            echo '</select>
                        </div>
                    </div>
                    <p>* Los niños van de 4 a 12 años</p>
                    <div class="text-center">
                        <input type="submit" placeholder="input fiels" value="' . $this->botonBuscar . '">
                    </div>

                </form>
            </div>
            <div class="side_text">
            <div id="titleR">' . $this->title . '</div>
            <div class="divider_s"></div>
            <p><br>';
        $itemsMenu = $this->context_menu->getItemsMenu();

        foreach ($itemsMenu as $item) {
            $nombre =  $item->getName();

            if($nombre == 'LOCALIZACIÓN') {
                 $nombre = 'LOCALIZACION';
            }


            if(strtoupper($page) != $nombre) {
                echo '<a href="'. $item->getLink() . '">' . $item->getName() . '</a><br><br>';
            }
        }

            echo '</p>
            </div>
            <div class="promocontainer">
                <h2>' . $this->promotions . '</h2>

                <div class="slider_wrapper" id="p1">
                    <ul id="slider">';

foreach ($this->t_promotions as $item) {
    echo '<li>
        <img src="' . $item->getImg() . '">
            <p>
                <span class="resaltar">' . $item->getTitle() . '</span>
                        <br><br>
                        ' . $item->getDesc() .
                        '</p>
                    </li>';
}

                    echo '</div>
                        <div id="tank">
                            <div class="slidenav">';

$n_items = count($this->t_promotions);
for ($i=1; $i <= $n_items; $i++) {
    echo '<input type="button" id="' . $i . '" class="btSld"/>';
}

                        echo '</div>
                    </div>
                </div>
                <div class="side_text">
                <div id="titleR">' . $this->contact . '</div>
                <div class="divider_s"></div>
                <p>
                <div class=resaltar>&#9900 ' . $this->address . '</div>
                ' . $this->location . '
                <br><br>
                <div class=resaltar>&#9900 ' . $this->phone . '</div> ' . $this->phone_number . '
                <br><br>
                <div class=resaltar>&#9900 Fax</div> ' . $this->fax . '
                <br><br>
                <div class=resaltar>&#9900 E-mail</div> ' . $this->email . '
                <br><br>
                </p>
                </div>

        </aside>';
    }
}



?>
