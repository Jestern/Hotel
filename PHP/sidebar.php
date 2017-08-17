<?php

require './PHP/class_sidebar.php';

$side = new ContentSide($conexion);

$side->showContent($page);

?>
