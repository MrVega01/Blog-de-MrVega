<?php
$title = "Recuperación de contraseña - Blog de MrVega";
include_once "scripts/generarSecretUrl.php";

if (isset($_POST["submit"])) {
  $email = $_POST["email"];

  Conexion::abrirConexion();
  $emailExiste = RepositorioUsuario::emailExiste(Conexion::obtenerConexion(), $email);

  if ($emailExiste) {
    $usuario = RepositorioUsuario::ObtenerUsuarioEmail(Conexion::obtenerConexion(), $email);
    $nombreUsuario = $usuario -> getNombre();

    $longitud = rand(15, 25);
    $stringAleatorio = sa($longitud);

    $urlSecreta = hash("sha256", $stringAleatorio . $nombreUsuario);

    $peticionGenerada = RepositorioRecuperarPassword::generarPeticion(Conexion::obtenerConexion(), $usuario -> getId(), $urlSecreta);
    if ($peticionGenerada) {
      Redireccion::redirigir(ROUTE_REQUEST_SUCCESS . "/" . $email);
    }
    Conexion::cerrarConexion();
  }
}

include_once "templates/header.inc.php";
include_once "templates/navbar.inc.php";
 ?>
<div class="container">
  <div class="row">
    <div class="col-md-3">
    </div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-header dark text-center">
          <h4>Recupera tu contraseña</h4>
        </div>
        <div class="card-body">
          <?php
          if (isset($_POST["submit"]) && isset($emailExiste) && !$emailExiste) {
            echo '<div class="alert alert-danger my-2" role="alert">No existe una cuenta asociada a ese email.</div>';
          }
           ?>
          <form action="<?php echo ROUTE_RECOVER_PASSWORD;?>" method="post">
            <div class="form-group">
          <!--    <label class="h6" for="emaillabel">Introduce tu email</label>
              <input class="form-control <?php// if (isset($_POST["submit"]) && isset($emailExiste) && !$emailExiste) {echo 'is-invalid';} ?>" type="email" name="email" placeholder="user@example.com" id="emaillabel" required autofocus>
            </div>
            <button class="form-control btn btn-danger mb-4 dark animation" type="submit" name="submit"><span>Enviar</span></button>
          </form> -->
        <div class="text-center">
          <p class="mt-2 text-muted">Esta función fue implementada en el código, pero no puede ser incluída debido a limitaciones del hosting.</p>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
include_once "templates/closing.inc.php";
?>
