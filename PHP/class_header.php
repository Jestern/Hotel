<?php
/**
 *
 */
class ItemMenu
{

    function __construct($name, $link)
    {
        $this->name = $name;
        $this->link = $link;
    }

    function getName() {
        return $this->name;
    }

    function getLink() {
        return $this->link;
    }
}


/**
 *
 */
class Menu
{

    function __construct($conexion)
    {
        $select = 'SELECT * FROM ItemMenu WHERE idioma="es" ORDER BY position ASC';
        $result = mysql_query($select, $conexion);

        $fila = mysql_fetch_assoc ($result);
        $this->inicio = new ItemMenu($fila["nombreItem"], $fila["url"]);
        $fila = mysql_fetch_assoc ($result);
        $this->hab = new ItemMenu($fila["nombreItem"], $fila["url"]);

        $select = 'SELECT s.nombreSubItem, s.url FROM SubItem s, ItemMenu i WHERE i.idioma="es" AND i.position=1 AND i.nombreItem=s.nombreItem ORDER BY s.position ASC';
        $result_hab = mysql_query($select, $conexion);
        $this->t_hab = array();
        while($fila = mysql_fetch_assoc ($result_hab)) {
            array_push($this->t_hab, new ItemMenu($fila["nombreSubItem"], $fila["url"]));
        }
        $fila = mysql_fetch_assoc ($result);
        $this->act = new ItemMenu($fila["nombreItem"], $fila["url"]);

        $select = 'SELECT s.nombreSubItem, s.url FROM SubItem s, ItemMenu i WHERE i.idioma="es" AND i.position=2 AND i.nombreItem=s.nombreItem ORDER BY s.position ASC';
        $result_act = mysql_query($select, $conexion);
        $this->t_act = array();
        while($fila = mysql_fetch_assoc ($result_act)) {
            array_push($this->t_act, new ItemMenu($fila["nombreSubItem"], $fila["url"]));
        }
        $fila = mysql_fetch_assoc ($result);
        $this->loc = new ItemMenu($fila["nombreItem"], $fila["url"]);
        $fila = mysql_fetch_assoc ($result);
        $this->cont = new ItemMenu($fila["nombreItem"], $fila["url"]);
    }

    function getInicio() {
        return $this->inicio;
    }

    function getHab() {
        return $this->hab;
    }

    function getHabs() {
        return $this->t_hab;
    }

    function getAct() {
        return $this->act;
    }

    function getActs() {
        return $this->t_act;
    }

    function getLoc() {
        return $this->loc;
    }

    function getCont() {
        return $this->cont;
    }

    function getItemsMenu() {
        return array($this->inicio, $this->hab, $this->act, $this->loc,
                     $this->cont);
    }
}
?>
