<?php
include_once "app/ControlSesion.inc.php";
include_once "app/Redireccion.inc.php";
include_once "app/ValidadorEntrada.inc.php";

if (!ControlSesion::comprobarSesion()) {
  Redireccion::redirigir(LOCALHOST);
}

$entradaBorrador = 1;
if (isset($_POST["submit"])) {
  Conexion::abrirConexion();

  $validador = new ValidadorEntrada($_POST["titulo"], htmlspecialchars($_POST["texto"]), Conexion::obtenerConexion());

  if (isset($_POST["borrador"]) && $_POST["borrador"] == "no") {
    $entradaBorrador = 0;
  }
  if ($validador-> EntradaValida()) {
    $entrada = new Entrada("", $_SESSION["id_usuario"], $validador -> ObtenerUrl(), $validador -> ObtenerTitulo(),
    $validador -> ObtenerTexto(), "", $entradaBorrador);

    $entrada_publicada = RepositorioEntrada::insertarEntrada(Conexion::obtenerConexion(), $entrada);

    if ($entrada_publicada) {
      Redireccion::redirigir(ROUTE_DASHBOARD_ENTRADAS);
    }
  }
  Conexion::cerrarConexion();
}

  $title= 'Escribir nueva entrada';
  include_once "templates/header.inc.php";
  include_once "templates/navbar.inc.php";
?>
<div class="container">
  <div class="jumbotron text-center dark">
    <h3 class="display-4">Escribe una entrada</h3>
    <p class="lead">Solo necesitas un título y algo que decir...</p>
  </div>
</div>
<div class="container">
  <div class="row rounded mb-3 fondo-form">
    <div class="col-12 p-3">
      <?php
        if (isset($_POST["submit"])) {
          include_once "templates/formValidadoEntradas.inc.php";
        }
        else {
          include_once "templates/formVacioEntradas.inc.php";
        }
      ?>
    </div>
  </div>
</div>
<?php
  include_once "templates/closing.inc.php";
?>
