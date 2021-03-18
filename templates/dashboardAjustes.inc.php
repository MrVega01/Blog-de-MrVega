<?php
/*header("Expires: Tue, 01 Jan 2000 00:00:00 GTM");
header("Last-Modified: ". gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0, false");
header("Pragma: no-cache");*/
Conexion::abrirConexion();
$id = $_SESSION["id_usuario"];
$usuario = RepositorioUsuario::ObtenerUsuarioId(Conexion::obtenerConexion(), $id);
Conexion::cerrarConexion();

$avisoInicioSuccess = '<div class="alert alert-success mt-2" role="alert">';
$avisoInicio = '<div class="alert alert-danger mt-2" role="alert">';
$avisoCierre = '</div>';

if (isset($_POST["submit"]) && !empty($_FILES["imagen"]["tmp_name"])) {
$directorio = ROUTE_ROOT . "/subidas/";
$carpetaObjetivo = $directorio.basename($_FILES['imagen']["name"]);
$subidacorrecta = true;
$tipoImagen = pathinfo($carpetaObjetivo, PATHINFO_EXTENSION);

$comprobacion = getimagesize($_FILES["imagen"]["tmp_name"]);
if (!$comprobacion) {
  $subidacorrecta = false;
}
if ($_FILES["imagen"]["size"] > 500000) {
  echo $avisoInicio . "El tamaño no puede superar los 500kb" . $avisoCierre;
  $subidacorrecta = false;
}
else {
  if (getimagesize($_FILES["imagen"]["tmp_name"])[0] > 800 || getimagesize($_FILES["imagen"]["tmp_name"])[0] < 400 &&
      getimagesize($_FILES["imagen"]["tmp_name"])[1] > 800 || getimagesize($_FILES["imagen"]["tmp_name"])[1] < 400) {
    echo $avisoInicio . "La resolución de la imagen debe estar entre 600x600 hasta 1000x1000" . $avisoCierre;
    $subidacorrecta = false;
  }
}
if ($tipoImagen != "jpg" && $tipoImagen != "jpeg" && $tipoImagen != "png" && $tipoImagen != "gif") {
  echo $avisoInicio . "Solo se admiten los archivos tipo PNG, JPG, JPEG y GIF..." . $avisoCierre;
  $subidacorrecta = false;
}
if ($subidacorrecta) {
  if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $directorio . $usuario-> getId())) {
    echo $avisoInicioSuccess . 'El archivo "' . basename($_FILES["imagen"]["name"]) . '" ha sido subido exitosamente (es posible que el cambio tarde en mostrarse).' . $avisoCierre;
  }
  else {
    echo $avisoInicio . "Ha habido un problema" . $avisoCierre;
    }
  }
}
elseif (empty($_FILES["imagen"]["tmp_name"]) && isset($_POST["submit"])) {
  echo $avisoInicio . "Debes seleccionar una imagen" . $avisoCierre;
}
?>
<div class="container perfil">
  <div class="row">
    <div class="col-md-3">
      <?php ComprobarExistenciaFotoPerfil::ComprobarYMostrarImagen($usuario -> getId()); ?>
      <form class="text-center" action="<?php echo ROUTE_DASHBOARD_AJUSTES; ?>" method="post" enctype="multipart/form-data">
        <label class="mt-3" for="labelImg" id="btnSubirImg">Sube una foto de perfil</label>
        <input type="file" name="imagen" id="labelImg" class="ocultarForm">
        <input type="submit" name="submit" class="btn btn-dark form-control" value="Guardar">
      </form>
    </div>
    <div class="col-md-9 marginResponsive">
      <h5><small>Nombre de usuario</small></h5>
      <h4><?php echo $usuario -> getNombre(); ?></h4>
      <br>
      <h5><small>Email</small></h5>
      <h4><?php echo $usuario -> getEmail(); ?></h4>
      <br>
      <h5><small>Usuario desde</small></h5>
      <h4><?php echo $usuario -> getFechaRegistro(); ?></h4>
    </div>
  </div>
</div>
