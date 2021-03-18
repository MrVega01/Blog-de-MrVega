<?php
abstract class Validador {

    protected $aviso_inicio;
    protected $aviso_cierre;

    protected $titulo;
    protected $texto;
    protected $url;

    protected $errorTitulo;
    protected $errorTexto;
    protected $errorUrl;

  protected function __construct(){

  }
  protected function variableIniciada($variable) {
    if (isset($variable) && !empty($variable)) {
      return true;
    }
    else {
      return false;
    }
  }
  protected function ComprobarTitulo($titulo) {
    $str_tratado = preg_replace("/\s+/", "", $titulo);
    if (!$this-> variableIniciada($str_tratado)) {
      return 'Debes insertar un título.';
    }
    else {
      $this-> titulo = $titulo;
    }
    if (strlen($titulo) < 15) {
      return 'El título debe contener por lo menos 15 caracteres.';
    }
    else {
      if (strlen($titulo) > 100) {
        return 'El título no puede exceder los 100 caracteres.';
      }
    }
  }
  protected function ComprobarTexto($texto){
    $str_tratado = preg_replace("/\s+/", "", $texto);
    if (!$this-> variableIniciada($str_tratado)) {
      return 'Debes completar este campo';
    }
    else {
      $this-> texto = $texto;
    }
    if (strlen($texto) < 200) {
      return 'El artículo debe abarcar por lo menos 200 caracteres.';
    }
  }
  protected function DefinirUrl($titulo){
    if (!empty($titulo)) {
      $url = ConversorURL::ConvertirUrl($titulo);
      $url = $_SESSION["id_usuario"] ."-". strtolower($url);
      $this-> url = $url;
      return $url;
    }
  }
  protected function ComprobarUrl($url, $conexion){
    if (RepositorioEntrada::UrlExiste($url, $conexion)) {
      return "Ya creaste un artículo con ese título, selecciona uno distinto.";
    }
  }
  public function ObtenerTitulo(){
    return $this-> titulo;
  }
  public function ObtenerTexto(){
    return $this-> texto;
  }
  public function ObtenerUrl(){
    return $this-> url;
  }
  public function MostrarTitulo(){
    if (!empty($this-> titulo)) {
      echo 'value=' . '"' . $this-> titulo . '"';
    }
  }
  public function MostrarTexto(){
    $str_tratado = preg_replace("/\s+/", "", $this-> texto);
    if (!empty($this-> texto) && strlen($str_tratado) > 0) {
      echo $this-> texto;
    }
  }
  public function MostrarErrorTitulo(){
    if (!empty($this-> errorTitulo)) {
      echo $this-> aviso_inicio . $this-> errorTitulo . $this-> aviso_cierre;
    }
  }
  public function MostrarErrorTexto(){
    if (!empty($this-> errorTexto)) {
      echo $this-> aviso_inicio . $this-> errorTexto . $this-> aviso_cierre;
    }
  }
  public function MostrarErrorUrl(){
    if (!empty($this-> errorUrl)) {
      echo $this-> aviso_inicio . $this-> errorUrl . $this-> aviso_cierre;
    }
  }
  public function EntradaValida(){
    if (empty($this-> errorTitulo) && empty($this-> errorTexto) && empty($this-> errorUrl)) {
      return true;
    }
    else {
      return false;
    }

  }
}
 ?>
