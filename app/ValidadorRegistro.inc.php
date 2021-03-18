<?php
include_once "app/RepositorioUsuario.inc.php";
include_once "app/ValidadorFormUsuario.inc.php";

class ValidadorRegistro extends ValidadorFormUsuario {

  function __construct($user, $email, $pass1, $pass2, $conexion) {

    $this-> avisoInicio = '<div class="alert alert-danger mt-2" role="alert">';
    $this-> avisoCierre = '</div>';

    $this-> user="";
    $this-> email="";
    $this-> password="";

    $this-> errorUser = $this-> validarUser($conexion, $user);
    $this-> errorEmail = $this-> validarEmail($conexion, $email);
    $this-> errorPass1 = $this-> validarPass1($pass1);
    $this-> errorPass2 = $this-> validarPass2($pass1, $pass2);

    if (empty($this-> errorPass1) && empty($this-> errorPass2)) {
      $this-> password = $pass1;
    }
  }

}

 ?>
