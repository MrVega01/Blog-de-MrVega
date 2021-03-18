<?php
include_once "app/Redireccion.inc.php";
include_once "app/RepositorioRecuperarPassword.inc.php";
include_once "app/ValidadorActualizarPassword.inc.php";
include_once "app/RepositorioConfirmacionEmail.inc.php";

Conexion::abrirConexion();

$id_usuario = RepositorioRecuperarPassword::urlSecretaExisteYDevolverIdUsuario(Conexion::obtenerConexion(), $url);

Conexion::cerrarConexion();
if ($id_usuario < 0) {
  echo "404";
}
else {
  if (isset($_POST["submit"])) {
    Conexion::abrirConexion();

    $validador = new ValidadorActualizarPassword($_POST["password"], $_POST["password2"]);
    if (empty($validador -> obtenerErrorPass1()) && empty($validador -> obtenerErrorPass2())) {

      Conexion:: obtenerConexion() -> beginTransaction();
      $passActualizada = RepositorioRecuperarPassword::actualizarPassword(
      password_hash($validador -> obtenerPassword(), PASSWORD_DEFAULT), Conexion::obtenerConexion(), $id_usuario);

      if ($passActualizada) {
        $peticionEliminada = RepositorioRecuperarPassword::eliminarPeticionDeRecuperacion(Conexion::obtenerConexion(), $id_usuario);
        $activar = RepositorioUsuario::activarCuenta(Conexion::obtenerConexion(), $id_usuario);
        $borrarPeticiones = RepositorioConfirmacionEmail::eliminarPeticionDeConfirmacion(Conexion::obtenerConexion(), $id_usuario);
        Conexion:: obtenerConexion() -> commit();

        if ($peticionEliminada) {
          Redireccion::redirigir(ROUTE_CORRECT_PASSWORD_UPDATE);
        }
      }
    }
    Conexion::cerrarConexion();
  }

  $title = "Recuperar contraseña - Blog de MrVega";
  include_once "templates/header.inc.php";
  include_once "templates/navbar.inc.php";
?>
<div class="container">
  <div class="row">
    <div class="col-md-1"></div>
      <div class="col-md-10">
        <div class="card">
          <div class="card-header dark text-center">
            <h5>Ingresa tu nueva contraseña.</h5>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6">
                <h6 class="text-center">¿Qué te recomendamos?</h6>
                <ul>
                  <li class="my-1">No uses una contraseña simple, o que incluya algo de tu nombre o email.</li>
                  <li class="my-3">Usa valores númericos, simbolos mayúsculas y minúsculas.</li>
                  <li class="my-1">Es más seguro usar una contraseña de 15 caracteres o más.</li>
                </ul>
              </div>
              <div class="col-lg-6">
                <form action="<?php echo ROUTE_NEW_PASSWORD . "/" . $url; ?>" method="post">
                  <label for="pass">Introduce tu nueva contraseña</label>
                  <input class="form-control <?php if (isset($_POST['submit'])) { echo 'is-invalid'; } ?>" type="password" name="password" autofocus required placeholder="Debe contener mínimo 8 carácteres" id="pass">
                  <?php if (isset($_POST["submit"])) { echo $validador -> mostrarErrorPass1(); } ?>
                  <label for="pass2" class="mt-1">Confirma tu nueva contraseña</label>
                  <input class="form-control <?php if (isset($_POST['submit'])) { echo 'is-invalid'; } ?>" type="password" name="password2" required placeholder="Deben coincidir ambos campos" id="pass2">
                  <?php if (isset($_POST["submit"])) { echo $validador -> mostrarErrorPass2(); } ?>
                  <button type="submit" name="submit" class="btn btn-danger dark animation form-control mt-2"><span>Finalizar</span></button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    <div class="col-md-1"></div>
  </div>
</div>
<?php
  include_once "templates/closing.inc.php";
}
?>
