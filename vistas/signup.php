<?php
include_once "app/ConversorURL.inc.php";
include_once "app/config.inc.php";
include_once "app/Conexion.inc.php";
include_once "app/Usuario.inc.php";
include_once "app/RepositorioUsuario.inc.php";
include_once "app/RepositorioConfirmacionEmail.inc.php";
include_once "app/ValidadorRegistro.inc.php";
include_once "app/Redireccion.inc.php";
include_once "app/ControlSesion.inc.php";

function sa($longitud){
$caracteres='1234567890qwertyuiopasdfghjklzxcvbnnmQWERTYUIOPASDFGHJKLZXCVBNM-';
$numerocaracteres=strlen($caracteres);
$string="";

for ($i= 0; $i < $longitud; $i++) {
  $string .= $caracteres[rand(0, $numerocaracteres - 1)];
}
return $string;
}

if (ControlSesion::comprobarSesion()) {
  Redireccion::redirigir(LOCALHOST);
}
if (isset ($_POST["submit"])) {
  Conexion :: abrirConexion();

  $validacion = new ValidadorRegistro($_POST["user"], $_POST["email"], $_POST["pass1"], $_POST["pass2"], Conexion::obtenerConexion());
  if ($validacion-> registroValido()) {
    Conexion:: obtenerConexion() -> beginTransaction();

    $usuario = new Usuario("", $validacion -> obtenerUser(), $validacion -> obtenerEmail(),
    password_hash($validacion -> obtenerPassword(), PASSWORD_DEFAULT), "", "");
    $insertarUsuario = RepositorioUsuario :: insertarUsuario(Conexion :: obtenerConexion(), $usuario);

    if ($insertarUsuario) {
      //GENERATE REQUEST
  /*    $usuarioCreado = RepositorioUsuario::ObtenerUsuarioEmail(Conexion::obtenerConexion(), $validacion -> obtenerEmail());
      $longitud = rand(15, 25);
      $stringAleatorio = sa($longitud);
      $url = hash("sha256", $stringAleatorio . $validacion -> obtenerEmail());
      $generarConsultaEmail = RepositorioConfirmacionEmail::crearPeticionDeConfirmacion(Conexion::obtenerConexion(), $usuarioCreado -> getId(), $url);

      if ($generarConsultaEmail) { */
        Conexion:: obtenerConexion() -> commit();
        //CORRECT SIGNUP
        Redireccion:: redirigir(ROUTE_CORRECT_SIGNUP . '/' . $usuario -> getEmail());
      //}
    }
  }
  Conexion :: cerrarConexion();
}


$title = "Registro - Blog de MrVega";
include_once "templates/header.inc.php";
include_once "templates/navbar.inc.php";
?>

<!--JUMBOTRON-->
<div class="container">
  <div class="jumbotron dark">
    <h1 class="text-center">Únete a nosotros</h1>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-6 mb-3">
      <div class="card">
        <div class="card-header dark text-center">
          <h6>Registro</h6>
        </div>
        <div class="card-body">
          <form method="post" action="<?php echo ROUTE_SIGNUP ?>">
            <?php
            if (isset ($_POST["submit"])) {
              include_once "templates/formValidado.inc.php";
            }
            else {
              include_once "templates/formVacio.inc.php";
            }
            ?>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-6 mb-3 text-center">
      <div class="card">
        <div class="card-header dark">
          <h6>Instrucciones de formulario</h6>
        </div>
        <div class="card-body">
          <p class="text-justify">
            Bienvenido al formulario de registro, para comenzar, debes proporcionar un nombre de usuario, contraseña y email,
            el email debe ser original, ya que luego del registro, deberás utilizarlo para poder confirmar tu cuenta. Te
            recomendamos que tu contraseña posea minúsculas, mayúsculas, números y simbolos.
          </p>
          <br>
          <br>
          <span>¿Ya tienes una cuenta? <span><a href="<?php echo ROUTE_LOGIN; ?>">Ingresa aqui</a>
          <br>
          <br>
          <span>¿Olvidaste tu contraseña? <span><a href="<?php echo ROUTE_RECOVER_PASSWORD; ?>">Recuperar</a>
          <br>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
  include_once "templates/closing.inc.php";
 ?>
