<?php
include_once "app/ConversorURL.inc.php";
include_once "app/Validador.inc.php";

class ValidadorEntradaEditada extends Validador {

  private $cambiosRealizados;
  private $checkbox;
  private $tituloOriginal;
  private $textoOriginal;
  private $urlOriginal;

  function __construct($titulo, $tituloOriginal, $texto, $textoOriginal, $url, $urlOriginal, $checkbox, $checkboxOriginal, $conexion)
  {
    $this-> titulo = $this-> DevolverVariableValidada($titulo);
    $this-> texto = $this-> DevolverVariableValidada($texto);
    $this-> url = $this-> DevolverVariableValidada($url);
    $this-> checkbox = $this-> DevolverVariableValidada($checkbox);

    if ($this-> titulo == $tituloOriginal &&
        $this-> texto == $textoOriginal &&
        $this-> url == $urlOriginal &&
        $this-> checkbox == 0) {

          $this-> cambiosRealizados = false;
    }
    else {
      $this-> cambiosRealizados = true;
    }
    if ($this-> cambiosRealizados) {
      $this-> checkbox = $this-> checkboxActivo($checkbox, $checkboxOriginal);

      $this-> aviso_inicio = '<div class="alert alert-danger my-2" role="alert">';
      $this-> aviso_cierre = '</div>';

      if ($this-> titulo !== $tituloOriginal) {
        $this-> errorTitulo =$this-> ComprobarTitulo($this-> titulo);
      }
      else {
        $this-> errorTitulo = "";
      }
      if ($this-> texto !== $textoOriginal) {
        $this-> errorTexto =$this-> ComprobarTexto($this-> texto);
      }
      else {
        $this-> errorTexto = "";
      }
      if ($this-> url !== $urlOriginal) {
        $this-> errorUrl =$this-> ComprobarUrl($this-> url, $conexion);
      }
      else {
        $this-> errorUrl = "";
      }
    }
  }
  private function DevolverVariableValidada($variable){
    if ($this-> variableIniciada($variable)) {
      return $variable;
    }
    else {
      return "";
    }
  }
  private function checkboxActivo($checkbox, $checkboxOriginal){
    if ($checkbox) {
      if ($checkboxOriginal) {
        $checkbox = 0;
      }
    }
    return $checkbox;
  }
  public function HayCambios(){
    return $this-> cambiosRealizados;
  }
  public function getCheckbox(){
    return $this-> checkbox;
  }
}

?>
