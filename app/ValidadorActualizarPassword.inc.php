<?php
include_once "ValidadorFormUsuario.inc.php";
class ValidadorActualizarPassword extends ValidadorFormUsuario {

  function __construct($pass1, $pass2) {
    $this-> avisoInicio = '<div class="alert alert-danger mt-2" role="alert">';
    $this-> avisoCierre = '</div>';

    $this-> errorPass1 = $this-> validarPass1($pass1);
    $this-> errorPass2 = $this-> validarPass2($pass1, $pass2);

    if (empty($this-> errorPass1) && empty($this-> errorPass2)) {
      $this-> password = $pass1;
    }
  }
}
?>
