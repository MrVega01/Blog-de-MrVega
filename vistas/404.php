<?php
header($_SERVER['SERVER_PROTOCOL'] . "404 Not Found", true, 404);

include_once "templates/header.inc.php";
include_once "templates/navbar.inc.php";
?>
<div class="container ventana404 text-center">
  <h3 class="display-3 my-4">Error 404 <i class="fas fa-heart-broken"></i></h3>
  <h3 class="lead my-4"><b>Lamentablemente no se ha encontrado el contenido que buscas...</b></h3>
  <a class="lead" href="<?php echo LOCALHOST; ?>"><b>Volver a inicio.</b></a>
</div>
<?php
include_once "templates/closing.inc.php";
?>
