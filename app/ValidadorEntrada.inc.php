<?php
include_once "app/ConversorURL.inc.php";
include_once "app/Validador.inc.php";
class ValidadorEntrada extends Validador {

  public function __construct($titulo, $texto, $conexion) {
    $this-> aviso_inicio = '<div class="alert alert-danger my-2" role="alert">';
    $this-> aviso_cierre = '</div>';

    $this-> titulo = '';
    $this-> texto = '';
    $this-> url = '';

    $this-> errorTitulo = $this-> ComprobarTitulo($titulo);
    $this-> errorTexto = $this-> ComprobarTexto($texto);
    $urlDefined = $this-> DefinirUrl($titulo);
    $this-> errorUrl = $this-> ComprobarUrl($urlDefined, $conexion);
  }
}
 ?>
