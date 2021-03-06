<?php
include_once "app/config.inc.php";
include_once "app/Conexion.inc.php";

include_once "app/Usuario.inc.php";
include_once "app/Comentario.inc.php";
include_once "app/Entrada.inc.php";

include_once "app/RepositorioUsuario.inc.php";
include_once "app/RepositorioComentario.inc.php";
include_once "app/RepositorioEntrada.inc.php";

include_once "app/ComprobarExistenciaFotoPerfil.inc.php";

$componentesUrl= parse_url($_SERVER['REQUEST_URI']);
$ruta = $componentesUrl['path'];
$partesRuta = explode('/', $ruta);
$partesRuta = array_filter($partesRuta);
$partesRuta = array_slice($partesRuta, 0);

$ruta_elegida='vistas/404.php';

if ($partesRuta[0] == "blog") {
  if (count($partesRuta) === 1) {
    $ruta_elegida='vistas/home.php';
  }
  elseif (count($partesRuta) === 2) {
    switch ($partesRuta[1]) {
      case 'informacion':
        $ruta_elegida='vistas/informacion.php';
      break;
      case 'login':
        $ruta_elegida='vistas/login.php';
      break;
      case 'logout':
        $ruta_elegida='scripts/logout.php';
      break;
      case 'signup':
        $ruta_elegida='vistas/signup.php';
      break;
      case 'dashboard':
        $ruta_elegida='vistas/dashboard.php';
        $dashboard_actual = '';
      break;
      case 'nueva-entrada':
        $ruta_elegida='vistas/nueva-entrada.php';
      break;
      case 'borrar-entrada':
        $ruta_elegida='scripts/deleteEntrada.php';
      break;
      case 'editar-entrada':
        $ruta_elegida='vistas/editarEntrada.php';
      break;
      case 'recuperar-contrasena':
        $ruta_elegida='vistas/recoverPassword.php';
      break;
      case 'generar-url':
        $ruta_elegida='scripts/generarSecretUrl.php';
      break;
      case "contrasena-actualizada":
        $ruta_elegida='vistas/correctPasswordUpdate.php';
      break;
      case "buscar":
        $ruta_elegida='vistas/search.php';
      break;

      case 'mail':
        $ruta_elegida='vistas/pruebaMail.php';
      break;
      case 'testbd':
        $ruta_elegida='scripts/script-relleno.php';
      break;
      default:
        $usuario = $partesRuta[1];
        Conexion::abrirConexion();
        $informacion = RepositorioUsuario::ObtenerUsuarioConNombre(Conexion::obtenerConexion(), $usuario);
        if (!empty($informacion)) {
          $ruta_elegida = "vistas/perfilUsuario.php";
        }
        Conexion::cerrarConexion();
      break;
    }
  }
  elseif (count($partesRuta) === 3) {
    if ($partesRuta[1] === "registro-correcto") {
      $nombre = $partesRuta[2];
      $ruta_elegida = "vistas/correctSignup.php";
    }
    if ($partesRuta[1] === 'entrada') {
      $url = $partesRuta[2];

      session_start();

      Conexion::abrirConexion();
      $entrada = RepositorioEntrada:: obtenerEntradaUrl(Conexion::obtenerConexion(), $url);
      if (!is_null($entrada)) {
        $autor = RepositorioUsuario::ObtenerUsuarioId(Conexion::obtenerConexion(), $entrada -> getAutorId());
      }

      if (!is_null($entrada) && $entrada -> getActiva() != 0 || isset($_SESSION["id_usuario"]) && isset($autor) && $_SESSION["id_usuario"] == $autor -> getId()) {
        $autor_name = $autor -> getNombre();
        $entradas_azar = RepositorioEntrada::obtenerEntradasAzar(Conexion::obtenerConexion(), 3);
        $comentarios = RepositorioComentario::ObtenerComentariosId(Conexion::obtenerConexion(), $entrada -> getId());

        $ruta_elegida = 'vistas/entradas.php';
      }
    }
    if ($partesRuta[1] === 'dashboard') {
      switch ($partesRuta[2]) {
        case 'ajustes':
          $dashboard_actual = 'Ajustes';
          $ruta_elegida = 'vistas/dashboard.php';
        break;
        case 'entradas':
          $dashboard_actual = 'Entradas';
          $ruta_elegida = 'vistas/dashboard.php';
        break;
        case 'comentarios':
          $dashboard_actual = 'Comentarios';
          $ruta_elegida = 'vistas/dashboard.php';
        break;
      }
    }
    if ($partesRuta[1] === "nueva-contrasena") {
      $url = $partesRuta[2];
      $ruta_elegida='vistas/nueva-contrasena.php';
    }
    if ($partesRuta[1] === "peticion-enviada") {
      $email = $partesRuta[2];
      $ruta_elegida='vistas/requestSuccess.php';
    }
    if ($partesRuta[1] === "cuenta-confirmada") {
      $url = $partesRuta[2];
      include_once "app/RepositorioConfirmacionEmail.inc.php";
      Conexion::abrirConexion();
      $peticion = RepositorioConfirmacionEmail::comprobarPeticionDeConfirmacion(Conexion::obtenerConexion(), $url);
      Conexion::cerrarConexion();
      if (count($peticion) && !empty($peticion)) {
        $ruta_elegida='vistas/cuentaConfirmada.php';
      }
    }
  }
}

include_once $ruta_elegida;

 ?>                                                                                                                                                
