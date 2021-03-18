<?php
include_once "app/ComprobarExistenciaFotoPerfil.inc.php";
include_once "app/EscritorEntradas.inc.php";
include_once "app/Redireccion.inc.php";

if ($entrada -> getActiva() == 1 || $_SESSION["id_usuario"] == $autor -> getId()) {

if (isset($_POST["comentar"]) && isset($_POST["comentario"])) {
  if (str_replace(' ', '', $_POST["comentario"]) != '') {
    $comentario = new Comentario('', $_SESSION["id_usuario"], $entrada->getId(), '', htmlspecialchars($_POST["comentario"]), '');
    Conexion::abrirConexion();
    $comentarioPublicado = RepositorioComentario::insertarComentario(Conexion::obtenerConexion(), $comentario);
    Conexion::cerrarConexion();
    if ($comentarioPublicado) {
      $recargar = LOCALHOST . "/" . $url;
      Redireccion::redirigir($url);
    }
  }
}

$title = $entrada -> getTitulo() . " - Blog de MrVega";
include_once "templates/header.inc.php";
include_once "templates/navbar.inc.php";

if ($entrada -> getActiva() == 0 && $_SESSION["id_usuario"] == $autor -> getId()) {
  echo '<div class="alert alert-warning my-2 text-center" role="alert">Esta entrada es solo visible para ti debido a que es un <b>borrador</b>.</div>';
}
?>
<div class="container-flex mx-5">
  <div class="row">
    <div class="card card-body col-md-8 text-center contenedorArticulo mb-2">
      <h2><?php echo $entrada -> getTitulo(); ?></h2>
        <p class="text-muted">Por  <a href="<?php echo LOCALHOST . "/" . strtolower($autor_name); ?>"><i class="fas fa-user"></i> <?php echo $autor_name; ?></a></p>

        <article class="text-justify">
        <p><?php echo nl2br($entrada -> getTexto()); ?></p>
        </article>

        <p class="text-muted mt-3">Escrito el <?php echo $entrada -> getFecha(); ?></p>
    </div>
    <?php include_once "templates/comentarioEntradas.inc.php"; ?>
  </div>
  <?php
  include_once "templates/entradasAzar.inc.php";
   ?>
</div>
<?php
Conexion::cerrarConexion();
include_once "templates/closing.inc.php";
}
?>
