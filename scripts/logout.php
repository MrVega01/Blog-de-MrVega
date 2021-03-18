<?php
include_once "app/ControlSesion.inc.php";
include_once "app/Redireccion.inc.php";
include_once "app/config.inc.php";

ControlSesion::cerrarSesion();
Redireccion::redirigir(LOCALHOST);
 ?>
