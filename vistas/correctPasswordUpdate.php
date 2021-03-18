<?php
include_once "app/config.inc.php";

$title = "Contraseña actualizada - Blog de MrVega";
include_once "templates/header.inc.php";
include_once "templates/navbar.inc.php";
?>
<div class="container">
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
      <div class="card text-center">
        <div class="card-header dark">
          <h6>Contraseña actualizada satisfactoriamente</h6>
        </div>
        <div class="card-body">
          <img class="imagesize" src="<?php echo ROUTE_CSS . "/img/success.png"; ?>" alt="success">
          <p>Para continuar, puedes <a href="<?php echo ROUTE_LOGIN; ?>">ingresar en tu cuenta aquí</a></p>
        </div>
      </div>
    </div>
    <div class="col-md-2"></div>
  </div>
</div>
<?php
include_once "templates/closing.inc.php";
?>
