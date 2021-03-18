<?php
include_once "app/config.inc.php";
include_once "app/ControlSesion.inc.php";

Conexion::abrirConexion();
$totalUsuarios = RepositorioUsuario::obtenerNumeroUsuarios(Conexion::obtenerConexion());
Conexion::cerrarConexion();
?>
<!--NAVEGATION-->
<nav class="navbar navbar-expand-lg navbar-light mb-3">
<div class="container">
<a href="<?php echo LOCALHOST; ?>" class="navbar-brand">MrVega</a>

<div class="navbar-dark">
  <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav" aria-expanded="false" aria-controls="navbarNavAltMarkup">
  <i class="navbar-toggler-icon"></i>
</div>
</button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <form class="form-inline" action="<?php echo ROUTE_SEARCH; ?>" method="post">
        <input type="search" name="busqueda" class="form-control mr-2 outlineColor searchPers" placeholder="¿Qué buscas?">
        <input type="hidden" name="check[]" value="titulo">
        <input type="hidden" name="check[]" value="contenido">
        <input type="hidden" name="ordered" value="desc">
        <button type="submit" name="submit" class="form-control btn-danger dark animation btnBuscar"><span>Buscar</span></button>
      </form>
      <?php if (ControlSesion::comprobarSesion()) { ?>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
            <button href="#" class="btn nav-link dropdown-toggle userIcon" id="usertoggler" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-user"></i>
              <span class="h6 mx-1"><?php echo ControlSesion::obtenerNombre(); ?></span>
            </button>
            <div class="dropdown-menu" id="darkcolor" aria-labelledby="usertoggler">
              <a href="<?php echo ROUTE_DASHBOARD_AJUSTES; ?>" class="dropdown-item"><i class="fas fa-user-cog fa-fw"></i> Ajustes</a>
              <a href="<?php echo ROUTE_DASHBOARD; ?>" class="dropdown-item"><i class="far fa-clipboard fa-fw"></i> Tablero</a>
              <a href="<?php echo ROUTE_DASHBOARD_ENTRADAS; ?>" class="dropdown-item"><i class="far fa-newspaper fa-fw"></i> Mis entradas</a>
              <a href="<?php echo ROUTE_DASHBOARD_COMENTARIOS; ?>" class="dropdown-item"><i class="fas fa-comments fa-fw"></i> Comentarios</a>
              <a href="<?php echo ROUTE_LOGOUT; ?>" class="dropdown-item"><i class="fas fa-sign-out-alt fa-fw"></i> Cerrar sesion</a>
            </div>
          </li>
        </ul>
      <?php } else { ?>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a href="<?php echo ROUTE_SIGNUP;?>" class="nav-link active"><i class="fas fa-user-plus"></i> Registrarse</a></li>
        <li class="nav-item"><a href="<?php echo ROUTE_LOGIN;?>" class="nav-link active"><i class="fas fa-sign-in-alt"></i> Iniciar sesión</a></li>
        <li class="nav-item"><span class="nav-link userCount"><i class="fas fa-users"></i>
          <?php
          print ($totalUsuarios);
          ?>
        </span></li>
      </ul>
      <?php } ?>
  </div>
</div>
</nav>
