<?php
include_once "app/Conexion.inc.php";
include_once "app/RepositorioUsuario.inc.php";
include_once "app/RepositorioEntrada.inc.php";
include_once "app/Entrada.inc.php";
include_once "app/EscritorEntradas.inc.php";
include_once "app/ControlSesion.inc.php";
$title = "Blog de MrVega";
include_once "templates/header.inc.php";
include_once "templates/navbar.inc.php";
?>
    <!--JUMBOTRON-->
    <div class="container">
      <div class="jumbotron dark jumboscale">
        <h1 class="display-4">Blog de MrVega</h1>
        <p class="lead">Blog dedicado a la programación y al desarrollo informático.</p>
        <!--POST-ARTICLE-->
        <?php if (ControlSesion::comprobarSesion()) { ?>
        <div class="text-center">
          <a class="mt-5 btn btn-block btn-lg btn-dark" role="button" href="<?php echo ROUTE_NEW_ENTRADA; ?>">Escribe una nueva entrada</a>
        </div>
        <?php } ?>
        <div class="text-center infospace">
          <a class="info lead" href="<?php echo ROUTE_INFO; ?>">Informacion y contacto <i class="fas fa-info-circle"></i></a>
        </div>
      </div>
    </div>
    <!--CONTENT-->
    <div class="container">
      <div class="row">

        <div class="col-md-12">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header dark">
                    <i class="far fa-clock"></i> Últimas entradas publicadas
                  </div>
                  <div class="card-body">
                    <?php
                    Conexion::abrirConexion();
                    if (RepositorioEntrada::obtenerEntradasFecha(Conexion::obtenerConexion())) {
                      EscritorEntradas::escribirEntradas(); }
                      else {
                    ?>
                    <p>No se han encontrado entradas en este momento... <i class="far fa-sad-cry"></i></p>
                    <?php } Conexion::cerrarConexion() ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
<?php
  include_once "templates/closing.inc.php";
 ?>
