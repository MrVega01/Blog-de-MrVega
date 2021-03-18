<?php
include_once "app/Entrada.inc.php";
include_once "app/RepositorioEntrada.inc.php";
include_once "app/ComprobarExistenciaFotoPerfil.inc.php";

class EscritorEntradas{

  public static function escribirEntradas(){
  $entradas= RepositorioEntrada::obtenerEntradasFecha(Conexion::obtenerConexion());
  if (count($entradas)) {
    foreach ($entradas as $entrada) {
      self::escribirEntrada($entrada);
    }
  }
  }
  public static function escribirEntrada($entrada){
    if (isset($entrada)) {
?>
    <div class="row">
      <div class="col-md-12">
        <div class="card mb-3">
          <div class="card-body text-justify">
            <div class="row align-items-center border-bottom mb-3 pb-1">
              <div class="col-12 imageSize">
                <?php $username = RepositorioUsuario::ObtenerNombreUsuarioId(Conexion::obtenerConexion(), $entrada -> getAutorId());?>
                <ul class="list-inline">
                  <li class="list-inline-item">
                  <a href="<?php echo LOCALHOST . "/" . strtolower($username) ?>"><?php ComprobarExistenciaFotoPerfil::ComprobarYMostrarImagen($entrada -> getAutorId()); ?></a>
                  </li>
                  <li class="list-inline-item">
                    <h5 class="text-muted"><a href="<?php echo LOCALHOST . "/" . strtolower($username) ?>"><i class="fas fa-user"></i> <?php echo $username; ?></a> (Autor)</h5>
                  </li>
                </ul>
              </div>
            </div>
            <h4 class="card-title text-center"><?php echo $entrada -> getTitulo() ?></h4>
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
    </div>
<?php
    }
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
