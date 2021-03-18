<?php
class EscritorEntradasBusqueda{
  public static function EscribirEntradasBusquedas($entradas){
    for ($i=0; $i < count($entradas); $i++) {
      $entradaActual = $entradas[$i];
      self::MostrarEntrada($entradaActual);
    }
  }
  private static function MostrarEntrada($entrada){
    ?>
    <div class="col-lg-4">
      <div class="card mb-3">
        <div class="card-body text-justify">
          <div class="row align-items-center border-bottom mb-3">
            <div class="col-12 imageSize">
              <?php $username = RepositorioUsuario::ObtenerNombreUsuarioId(Conexion::obtenerConexion(), $entrada -> getAutorId());?>
              <ul class="list-inline">
                <li class="list-inline-item">
                <a href="<?php echo LOCALHOST . "/" . strtolower($username) ?>"><?php ComprobarExistenciaFotoPerfil::ComprobarYMostrarImagen($entrada -> getAutorId()); ?></a>
                </li>
                <li class="list-inline-item">
                  <h5><a href="<?php echo LOCALHOST . "/" . strtolower($username) ?>"><i class="fas fa-user"></i> <?php echo $username; ?></a></h5>
                </li>
              </ul>
            </div>
          </div>
          <h5 class="card-title text-center"><?php echo $entrada -> getTitulo() ?></h5>
          <p class="card-text"><?php echo self::resumirTexto(nl2br($entrada -> getTexto())) ?></p>
          </div>
        <div class="card-footer text-muted">
          <div class="row">
            <div class="col-6">
              <a class="btn btn-danger dark animation" href="<?php echo ROUTE_ENTRADA . "/" . $entrada -> getUrl();?>"><span>Ver completo  <i class="fas fa-arrow-alt-circle-right"></i></span></a>
            </div>
            <div class="col-6 my-auto text-right">
              <?php echo $entrada -> getFecha() ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
  }
  public static function resumirTexto($texto){
    $maxCaracteres= 400;
    $resultado= "";

    if (strlen($texto) > $maxCaracteres) {
      $resultado = substr($texto, 0, $maxCaracteres);

      $resultado .= "...";
    }
    else {
      $resultado = $texto;
    }
    return $resultado;
  }
}


?>
