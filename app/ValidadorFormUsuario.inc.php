<?php
abstract class ValidadorFormUsuario {

  protected $avisoInicio;
  protected $avisoCierre;

  protected $user;
  protected $email;
  protected $password;

  protected $errorUser;
  protected $errorEmail;
  protected $errorPass1;
  protected $errorPass2;

  protected function __construct() {
  }

  protected function variableIniciada($variable) {
    if (isset($variable) && !empty($variable)) {
      return true;
    }
    else {
      return false;
    }
  }
  protected function validarUser($conexion, $user) {
  if (!$this-> variableIniciada($user)) {
    return "Debes introducir un nombre de usuario.";
  }
  else {
    $this-> user = $user;
  }
  if (strlen($user) < 6 || strlen($user) > 24) {
    return "El nombre de usuario debe contener entre 6 y 24 caracteres.";
  }
  if (RepositorioUsuario :: userExiste($conexion, $user)) {
    return "Este nombre de usuario ya está en uso, por favor inserta otro.";
  }
  if ($user != ConversorURL::ConvertirUrl($user)) {
    return "El nombre de usuario no puede incluir carácteres especiales.";
  }
  return "";
  }
  protected function validarEmail($conexion, $email){
    if (!$this-> variableIniciada($email)) {
      return "Debes ingresar un email.";
    }
    else {
      $this-> email = $email;
    }
    if (RepositorioUsuario :: emailExiste($conexion, $email)) {
      return 'El email ingresado ya está en uso.';
    }

    return "";
  }
  protected function validarPass1($pass1){
    if (!$this-> variableIniciada($pass1)) {
      return "Debes ingresar una contraseña.";
    }
    if (strlen($pass1) < 8) {
      return "Tu contraseña debe tener más de 8 caracteres.";
    }
    return "";
  }
  protected function validarPass2($pass1, $pass2){
    if (!$this-> variableIniciada($pass2)) {
      return "Debes volver a introducir tu contraseña.";
    }
    if (!$this-> variableIniciada($pass1)) {
      return "Debes llenar ambos campos de contraseña.";
    }
    if ($pass1 !== $pass2) {
      return "Tu contraseña no coincide, vuelve a intentarlo.";
    }
    return "";
  }
  public function obtenerUser() {
    return $this-> user;
  }
  public function obtenerEmail() {
    return $this-> email;
  }
  public function obtenerPassword() {
    return $this-> password;
  }
  public function obtenerErrorUser() {
    return $this-> errorUser;
  }
  public function obtenerErrorEmail() {
    return $this-> errorEmail;
  }
  public function obtenerErrorPass1() {
    return $this-> errorPass1;
  }
  public function obtenerErrorPass2() {
    return $this-> errorPass2;
  }

  public function mostrarUser(){
    if (!empty($this-> user)) {
      echo 'value="' . $this-> user . '"';
    }
  }
  public function mostrarErrorUser(){
    if ($this-> errorUser !== "") {
      echo $this-> avisoInicio . $this-> errorUser . $this-> avisoCierre;
    }
  }
  public function mostrarEmail(){
    if (!empty($this-> email)) {
      echo 'value="' . $this-> email . '"';
    }
  }
  public function mostrarErrorEmail(){
    if (!empty($this-> errorEmail)) {
      echo $this-> avisoInicio . $this-> errorEmail . $this-> avisoCierre;
    }
  }
  public function mostrarErrorPass1(){
    if (!empty($this-> errorPass1)) {
      echo $this-> avisoInicio . $this-> errorPass1 . $this-> avisoCierre;
    }
  }
  public function mostrarErrorPass2(){
    if (!empty($this-> errorPass2)) {
      echo $this-> avisoInicio . $this-> errorPass2 . $this-> avisoCierre;
    }
  }
  public function registroValido(){
    if (empty($this-> errorUser) &&
        empty($this-> errorEmail) &&
        empty($this-> errorPass1) &&
        empty($this-> errorPass2)) {
      return true;
    }
    else {
      return false;
    }
  }
}

?>
