<?php
include_once "app/config.inc.php";
include_once "app/Conexion.inc.php";
include_once "app/RepositorioUsuario.inc.php";
include_once "app/Redireccion.inc.php";
include_once "app/ControlSesion.inc.php";

if (ControlSesion::comprobarSesion()) {
  Redireccion::redirigir(LOCALHOST);
}

  $title = "Registro correcto";

  include_once "templates/header.inc.php";
  include_once "templates/navbar.inc.php";
 ?>

<div class="container">
  <div class="row">
    <div class="col-md-12 text-center">
      <div class="card">
        <div class="card-header dark">
           <h5><i class="fas fa-check"></i> Registro completado <i class="fas fa-check"></i></h5>
        </div>
        <div class="card-body">
          <p class="lead"><strong>¡Gracias por registrarte!</strong></p>
          <br>
          <p>Tu cuenta ha sido creada exitosamente, <a href="<?php echo ROUTE_LOGIN; ?>"><strong>pulsa aquí para ingresar.</strong></a></p>
        </div>
      </div>
    </div>
  </div>
</div>



<?php
  include_once "templates/closing.inc.php";
 ?>
