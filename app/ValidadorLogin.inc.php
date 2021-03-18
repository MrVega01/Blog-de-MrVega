<?php
class ValidadorLogin {

  private $email;
  private $error;

  function __construct($email, $password, $conexion) {

    if (!$this-> variableIniciada($email) || !$this-> variableIniciada($password)) {
      $this-> error = "Debes introducir ambos campos";
    }
    else {
      $this-> usuario = RepositorioUsuario::ObtenerUsuarioEmail($conexion, $email);

      if (is_null($this-> usuario)) {
      $this-> error = 'No existe una cuenta asociada a ese email';
      }
      else {
        if (!password_verify($password, $this-> usuario -> getPassword())) {
          $this-> error = "La contraseña ingresada no es correcta.";
        }
        elseif ($this-> usuario -> getActivo() == 0) {
          $this-> error = "Tu cuenta aún no ha sido verificada, para verificarla debes ingresar desde el enlace que se te ha sido enviado a tu <b>correo electrónico</b>.";
        }
      }
    }
  }

  private function variableIniciada($variable){
    if (!empty($variable) && isset($variable)) {
      return true;
    }
    else {
      return false;
    }
  }
  public function obtenerUsuario(){
    return $this-> usuario;
  }
  public function obtenerError(){
    return $this-> error;
  }
  public function mostrarError(){
    if (!empty($this-> error)) {
      echo '<div class="alert alert-danger" role="alert">' . $this-> error . '</div>';
    }
  }
}


 ?>
