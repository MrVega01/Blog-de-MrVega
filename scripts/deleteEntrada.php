<?php
include_once "app/config.inc.php";
include_once "app/Conexion.inc.php";
include_once "app/RepositorioEntrada.inc.php";
include_once "app/Redireccion.inc.php";

if (isset($_POST["borrar"])) {
  Conexion::abrirConexion();
  RepositorioEntrada::BorrarEntradaYComentarios($_POST["id_borrar"], Conexion::obtenerConexion());
  Redireccion::redirigir(ROUTE_DASHBOARD_ENTRADAS);
  Conexion::cerrarConexion();
}
  else {
    Redireccion::redirigir(LOCALHOST);
  }
 ?>
