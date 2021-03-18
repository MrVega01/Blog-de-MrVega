<?php
include_once 'app/Redireccion.inc.php';
include_once 'app/ControlSesion.inc.php';

if (!ControlSesion::comprobarSesion()) {
  Redireccion::redirigir(LOCALHOST);
}
if ($dashboard_actual != '') {
  $title = "Dashboard " . $dashboard_actual . " - Blog de MrVega";
}
else {
$title = 'Dashboard - Blog de MrVega';
}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <?php
    if (!isset($title) || empty($title)) {
      $title = "Blog de MrVega";
    }
    echo "<title>$title</title>";
    ?>
    <link rel="stylesheet" href="<?php echo ROUTE_CSS ?>/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo ROUTE_CSS ?>/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  </head>
  <body id="<?php switch ($dashboard_actual) {
    case '':
      echo "defaultStyle";
    break;
    case 'Entradas':
      echo "entradasStyle";
    break;
    case 'Ajustes':
      echo "ajustesStyle";
    break;
    case 'Comentarios':
      echo "comentariosStyle";
    break;
  } ?>">
<?php
include_once 'templates/navbar.inc.php';
include_once 'templates/panelControlHeader.inc.php';

switch ($dashboard_actual) {
  case '':
    Conexion::abrirConexion();
    $cantidad_entradas = RepositorioEntrada::contarEntradasActivas(Conexion::obtenerConexion(), $_SESSION['id_usuario']);
    $cantidad_entradas_in = RepositorioEntrada::contarEntradasInactivas(Conexion::obtenerConexion(), $_SESSION['id_usuario']);
    $cantidad_comentarios = RepositorioComentario::contarComentarios(Conexion::obtenerConexion(), $_SESSION['id_usuario']);
    Conexion::cerrarConexion();
    include_once 'templates/dashboardDefault.inc.php';
  break;
  case 'Entradas':
    Conexion::abrirConexion();
    $array_entradas = RepositorioEntrada::MostrarEntradaYComentarios(Conexion::obtenerConexion(), $_SESSION['id_usuario']);
    Conexion::cerrarConexion();
    include_once 'templates/dashboardEntradas.inc.php';
  break;
  case 'Ajustes':
    include_once 'templates/dashboardAjustes.inc.php';
  break;
  case 'Comentarios':
    include_once 'templates/dashboardComentarios.inc.php';
  break;
}
?>

<?php
include_once 'templates/panelControlClosing.inc.php';
include_once 'templates/closing.inc.php';
?>
