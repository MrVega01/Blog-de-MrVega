<?php
include_once "app/ControlSesion.inc.php";
include_once "app/Redireccion.inc.php";
include_once "app/ValidadorEntradaEditada.inc.php";

if (!isset($_POST['editar']) && !isset($_POST['submit'])) {
  Redireccion::redirigir(ROUTE_DASHBOARD_ENTRADAS);
}
Conexion::abrirConexion();
if (isset($_POST["submit"])) {
  $cambioEstado = 0;
  if (isset($_POST["borrador"]) && $_POST["borrador"] == "activador") {
    $cambioEstado = 1;
  }
  $entrada_original = RepositorioEntrada::obtenerEntradaId(Conexion::obtenerConexion(), $_POST["id_entrada"]);
  $url = ConversorURL::DefinirUrl($_POST["titulo"], $entrada_original -> getAutorId());
  $validador = new ValidadorEntradaEditada($_POST["titulo"], $entrada_original -> getTitulo(), htmlspecialchars($_POST["texto"]),
  $entrada_original -> getTexto(), $url, $entrada_original -> getUrl(), $cambioEstado, $entrada_original -> getActiva(),
  Conexion::obtenerConexion());

  if ($validador -> HayCambios()) {
    if ($validador -> EntradaValida()) {
      $entradaRenovada = RepositorioEntrada::actualizarEntrada(Conexion::obtenerConexion(), $_POST["id_entrada"],
      $validador -> ObtenerTitulo(), $validador -> ObtenerTexto(), $validador -> ObtenerUrl(), $validador -> getCheckbox());

      if ($entradaRenovada) {
        Redireccion::redirigir(ROUTE_DASHBOARD_ENTRADAS);
      }
    }
  }
  else {
    Redireccion::redirigir(ROUTE_DASHBOARD_ENTRADAS);
  }
}
$title= 'Editar entrada';
include_once "templates/header.inc.php";
include_once "templates/navbar.inc.php";
Conexion::abrirConexion();
?>
<div class="container">
  <div class="jumbotron dark">
    <h1 class="display-4 text-center">Editar entrada</h1>
    <h2 class="text-center"><i class="fas fa-highlighter"></i></h2>
  </div>
</div>
<div class="container">
  <div class="row rounded mb-3 fondo-form">
    <div class="col-12 p-3">
      <?php if (isset($_POST["editar"])){
              include_once "templates/formRecuperado.inc.php";
              Conexion::cerrarConexion();
            }
            elseif (isset($_POST["submit"])) {
              include_once "templates/formRecuperadoValidado.inc.php";
              Conexion::cerrarConexion();
            }
        ?>
    </div>
  </div>
</div>
<?php
include_once "templates/closing.inc.php";
?>
