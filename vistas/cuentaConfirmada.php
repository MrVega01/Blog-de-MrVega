<?php
include_once "app/ControlSesion.inc.php";
include_once "app/Redireccion.inc.php";

if (ControlSesion::comprobarSesion()) {
  Redireccion::redirigir(LOCALHOST);
}
Conexion::abrirConexion();
$usuario = RepositorioUsuario::ObtenerUsuarioId(Conexion::obtenerConexion(), $peticion["usuario_id"]);

if (!empty($usuario)) {
  Conexion:: obtenerConexion() -> beginTransaction();
  $activacion = RepositorioUsuario::activarCuenta(Conexion::obtenerConexion(), $usuario -> getId());
  $eliminacionPeticion = RepositorioConfirmacionEmail::eliminarPeticionDeConfirmacion(Conexion::obtenerConexion(), $usuario -> getId());
  Conexion:: obtenerConexion() -> commit();
}
  Conexion::cerrarConexion();
if (isset($activacion) && $activacion && isset($eliminacionPeticion) && $eliminacionPeticion) {
  include_once "templates/header.inc.php";
  include_once "templates/navbar.inc.php";
?>
<div class="container text-center ventanaCuentaConfirmada">
  <h3 class="display-4 mb-3">¡Tú cuenta ha sido activada!</h3>
  <img class="imagesize" src="<?php echo ROUTE_CSS . "/img/success.png"; ?>" alt="success">
  <p class="lead"><b>Ya posees acceso a tu cuenta, <a href="<?php echo ROUTE_LOGIN; ?>">accede desde este enlace</a> y disfruta de los beneficios</b></p>
</div>
<?php
include_once "templates/closing.inc.php";
}
?>
