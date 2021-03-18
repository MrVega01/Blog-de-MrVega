<?php
include_once "app/EscritorEntradasBusqueda.inc.php";
$title = $informacion -> getNombre() . " - Blog de MrVega";
include_once "templates/header.inc.php";
include_once "templates/navbar.inc.php";
?>
<div class="container contenedorArticulo">
  <div class="row">
    <div class="col-md-3">
      <?php ComprobarExistenciaFotoPerfil::ComprobarYMostrarImagen($informacion-> getId()); ?>
    </div>
    <div class="col-md-9 marginResponsive">
      <h5><small>Nombre de usuario</small></h5>
      <h4><?php echo $informacion -> getNombre(); ?></h4>
      <br>
      <h5><small>Usuario desde</small></h5>
      <h4><?php echo $informacion -> getFechaRegistro(); ?></h4>
      <br>
      <h5><small>Estado de la cuenta</small></h5>
      <h4><?php
      if ($informacion -> getActivo()) {
        echo "Activa";
      }
      else {
        echo "Inactiva";
      }
       ?></h4>
    </div>
  </div>
</div>
<div class="container-fluid my-2">
  <div class="card card-body">
    <?php
    Conexion::abrirConexion();
    $entradas = RepositorioEntrada::obtenerEntradasPublicasAutorId(Conexion::obtenerConexion(), $informacion -> getId());
    ?>
    <h3 class="text-center my-4">Entradas publicadas <small class="text-muted">(<?php echo count($entradas); ?>)</small></h3>
    <?php
    if (!empty($entradas)) {
    ?>
    <div class="row">
    <?php
      EscritorEntradasBusqueda::EscribirEntradasBusquedas($entradas);
    ?>
    </div>
    <?php
    }
    else {
    ?>
    <p class="lead text-center">Este usuario no ha publicado entradas...</p>
    <?php
    }
    Conexion::cerrarConexion();
    ?>
  </div>
</div>
<?php
include_once "templates/closing.inc.php";
?>
