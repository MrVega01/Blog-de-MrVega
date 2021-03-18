<?php
include_once "app/EscritorPerfilUsuarios.inc.php";
include_once "app/ValidadorBusqueda.inc.php";
include_once "app/EscritorEntradasBusqueda.inc.php";
include_once "app/RepositorioBuscarEntradas.inc.php";
include_once "app/ComprobarExistenciaFotoPerfil.inc.php";

$buscar = "";
$resultados = [];
if (isset($_POST["submit"]) && isset($_POST["busqueda"]) && !empty($_POST["busqueda"]) && isset($_POST["check"])) {
  $buscar = ValidadorBusqueda::EliminarEspacios($_POST["busqueda"]);
  if (!empty($buscar)) {
    Conexion::abrirConexion();
    $resultados = RepositorioBuscarEntradas::BuscarEntradasConChecks(Conexion::obtenerConexion(), $_POST["busqueda"], $_POST["check"], $_POST["ordered"]);
    Conexion::cerrarConexion();
  }
  //ORDEN
  if ($_POST["ordered"] == "desc") {
    $descendente = true;
  }
  else {
    $descendente = false;
  }
  //CHECKS
  if (isset($_POST["check"]) && in_array("titulo", $_POST["check"]) && in_array("contenido", $_POST["check"]) && !in_array("autores", $_POST["check"])) {
    $cambios = false;
  }
  else {
    $cambios = true;
  }


}
$title = "Buscar - Blog de MrVega";
include_once "templates/header.inc.php";
include_once "templates/navbar.inc.php";
?>
<div class="container">
  <div class="jumbotron dark">
    <h3 class="display-4 text-center">Buscar en el blog</h3>
    <br>
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <form action="<?php echo ROUTE_SEARCH; ?>" method="post">
          <div class="form-group">
            <input type="search" name="busqueda" class="form-control" placeholder="¿Qué buscas?"
            value="<?php echo $_POST["busqueda"]; ?>">
          </div>
          <button type="submit" name="submit" class="form-control btn-dark"><span>Buscar <i class="fas fa-search"></i></span></button>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <div class="mt-3 border-checks">
            <button type="button" class="form-control btn btn-danger avanzado" data-toggle="collapse" data-target="#options" aria-controls="options" aria-expanded="false">
              Opciones avanzadas <i class="fas fa-cogs"></i>
            </button>
            <div class="collapse" id="options">
              <div class="row">
                <div class="col-md-5 ml-4">
                  <div class="form-check my-3">
                    <input class="form-check-input" type="checkbox" name="check[]" value="autores" id="autores"
                    <?php if (isset($cambios) && $cambios) {
                      if (in_array("autores", $_POST["check"])) {
                        echo "checked";
                      }}?>>
                    <label class="form-check-label" for="autores">Autores</label>
                  </div>
                  <div class="form-check my-3">
                    <input class="form-check-input" type="checkbox" name="check[]" value="titulo" id="titulo"
                    <?php if (isset($cambios) && $cambios) {
                      if (in_array("titulo", $_POST["check"])) {
                        echo "checked";
                      }
                    } else {
                      echo "checked";
                    } ?>>
                    <label class="form-check-label" for="titulo">Título</label>
                  </div>
                  <div class="form-check my-3">
                    <input class="form-check-input" type="checkbox" name="check[]" value="contenido" id="contenido"
                    <?php if (isset($cambios) && $cambios) {
                      if (in_array("contenido", $_POST["check"])) {
                        echo "checked";
                      }
                    } else {
                      echo "checked";
                    } ?>>
                    <label class="form-check-label" for="contenido">Contenido</label>
                  </div>
                </div>
                <div class="col-md-5 ml-4">
                  <div class="form-check my-3">
                    <input class="form-check-input" type="radio" name="ordered" value="desc" id="desc"
                    <?php if (!isset($descendente)) { echo "checked"; } else { if ($descendente) { echo "checked";}}?>>
                    <label class="form-check-label" for="desc">Mostrar más recientes.</label>
                  </div>
                  <div class="form-check my-3">
                    <input class="form-check-input" type="radio" name="ordered" value="asc" id="asc"
                    <?php if (isset($descendente) && !$descendente) { echo "checked"; } ?>>
                    <label class="form-check-label" for="asc">Mostrar más antiguas.</label>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid">
  <div class="card mb-3">
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <h3 class="text-left ml-3 mb-3">Resultados <small>(<?php echo count($resultados); ?>)</small></h3>
        </div>
        <?php
        if (count($resultados) && !empty($resultados)) {
          if (isset($_POST["check"]) && in_array("autores", $_POST["check"])) {
            //MOSTRADOR DE USUARIOS
            EscritorPerfilUsuarios::EscribirUsuarios($resultados);
          }
          elseif (isset($_POST["check"]) && in_array("titulo", $_POST["check"]) || in_array("contenido", $_POST["check"])) {
            Conexion::abrirConexion();
            EscritorEntradasBusqueda::EscribirEntradasBusquedas($resultados);
            Conexion::cerrarConexion();
          }
        }
        else {
          if (isset($_POST["submit"]) && isset($buscar) && !empty($buscar)) {
            ?>
              <div class="col-md-12">
                <p class="lead text-center">No se han encontrado coincidencias... <i class="far fa-sad-cry"></i></p>
              </div>
            <?php
          }
          else {}
        }
        ?>
      </div>
    </div>
  </div>
</div>
<?php
include_once "templates/closing.inc.php";
?>
