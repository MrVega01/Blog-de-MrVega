<?php

$title = "Petición completada - Blog de MrVega";
include_once "templates/header.inc.php";
include_once "templates/navbar.inc.php";
?>
<div class="container">
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
      <div class="card text-center">
        <div class="card-header dark">
          <h6>La operación ha sido completada</h6>
        </div>
        <div class="card-body">
          <p>Se ha enviado un enlace a la dirección <strong><?php echo $email; ?></strong></p>
          <br>
          <p class="text-muted">Para restaurar su contraseña debe confirmar su identidad e ingresar desde el enlace que le hemos enviado.</p>
        </div>
      </div>
    </div>
    <div class="col-md-1"></div>
  </div>
</div>
<?php
include_once "templates/closing.inc.php";
?>
