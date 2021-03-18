<?php
include_once "app/config.inc.php";

class ComprobarExistenciaFotoPerfil{
  public static function ComprobarYMostrarImagen($usuarioId) {
    if (file_exists(ROUTE_ROOT . "/subidas/" . $usuarioId)) {
      ?>
      <img class="img-fluid" src="<?php echo LOCALHOST . '/subidas/' . $usuarioId; ?>" alt="user-photo">
      <?php
      }
      else { ?>
      <img class="img-fluid" src="<?php echo ROUTE_CSS . 'img/profile.svg' ?>" alt="user-photo">
    <?php
    }
  }
}
?>
