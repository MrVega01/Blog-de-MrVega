<?php
include_once "app/config.inc.php";
include_once "app/RepositorioUsuario.inc.php";
include_once "app/Redireccion.inc.php";
include_once "app/Conexion.inc.php";
include_once "app/ValidadorLogin.inc.php";
include_once "app/Usuario.inc.php";
include_once "app/ControlSesion.inc.php";

if (ControlSesion::comprobarSesion()) {
  Redireccion::redirigir(LOCALHOST);
}
if (isset($_POST["submit"])) {
  Conexion::abrirConexion();
  $validador = new ValidadorLogin($_POST["email"], $_POST["password"], Conexion::obtenerConexion());

  if (empty($validador -> obtenerError())) {
    //INICIO DE SESION
  ControlSesion::iniciarSesion($validador -> obtenerUsuario() -> getId(), $validador -> obtenerUsuario() -> getNombre());
    //REDIRECCION A INDEX O ENTRADAS
    Redireccion::redirigir(LOCALHOST);
  }
  Conexion::cerrarConexion();
}

$title = "Ingresa - Blog de MrVega";
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
          <h4>Iniciar sesión</h4>
        </div>
        <div class="card-body">
          <?php
          if (isset($_POST["submit"]) &&  !empty($validador-> obtenerError())) {
            echo $validador -> mostrarError();
          }
           ?>
          <form action="<?php echo ROUTE_LOGIN?>" method="post">
            <div class="form-group">
              <label class="h6" for="emaillabel">Introduce tu email</label>
              <input class="form-control <?php if (isset($_POST["submit"]) && isset($_POST["email"]) && !empty($_POST["email"])) {
                echo 'is-invalid';
              } ?>" type="email" name="email" placeholder="Email" id="emaillabel"
              <?php
              if (isset($_POST["submit"]) && isset($_POST["email"]) && !empty($_POST["email"])) {
                echo 'value="' . $_POST["email"] . '"';
              }
              ?>
               required autofocus>
            </div>
            <div class="form-group">
              <label class="h6" for="passwordlabel">Ingresa tu contraseña</label>
              <input class="form-control <?php if (isset($_POST["submit"]) && isset($_POST["email"]) && !empty($_POST["email"])) {
                echo 'is-invalid';
              } ?>" type="password" name="password" placeholder="Contraseña" id="passwordlabel" required>
            </div>
              <button class="form-control btn btn-danger mb-4 dark animation" type="submit" name="submit"><span>Ingresar</span></button>
            </form>
            <div class="text-center">
              <a href="<?php echo ROUTE_RECOVER_PASSWORD; ?>">¿Olvidaste tu contraseña?</a>
              <p class="mt-2">¿Aún no tienes cuenta? <a href="<?php echo ROUTE_SIGNUP; ?>">Registrate</a>.</p>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
include_once "templates/closing.inc.php";
 ?>
