<?php
class EscritorPerfilUsuarios {
  public static function EscribirUsuarios($usuarios) {
    foreach ($usuarios as $fila) {
      self::Estructura($fila);
    }
  }
  private static function Estructura($usuario) {
    if (isset($usuario)) {
    ?>
    <div class="col-md-6 my-2">
      <div class="card card-body">
        <div class="imageSize2 text-center mb-2">
         <a href="<?php echo LOCALHOST . "/" . strtolower($usuario -> getNombre()); ?>"><?php ComprobarExistenciaFotoPerfil::ComprobarYMostrarImagen($usuario -> getId()); ?></a>
        </div>
        <div class="text-center">
          <a class="lead" href="<?php echo LOCALHOST . "/" . strtolower($usuario -> getNombre()); ?>"><strong><?php echo $usuario -> getNombre(); ?></strong></a>
        </div>
      </div>
    </div>
    <?php
    }
  }
}
?>
