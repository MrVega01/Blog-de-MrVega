<?php
class Entrada {
  private $id;
  private $autor_id;
  private $url;
  private $titulo;
  private $texto;
  private $fecha;
  private $activa;

  public function __construct($id, $autor_id, $url, $titulo, $texto, $fecha, $activa){
    $this-> id = $id;
    $this-> autor_id = $autor_id;
    $this-> url = $url;
    $this-> titulo = $titulo;
    $this-> texto = $texto;
    $this-> fecha = $fecha;
    $this-> activa = $activa;
  }
  public function getId(){
    return $this-> id;
  }
  public function getAutorId(){
    return $this-> autor_id;
  }
  public function getUrl(){
    return $this-> url;
  }
  public function getTitulo(){
    return $this-> titulo;
  }
  public function getTexto(){
    return $this-> texto;
  }
  public function getFecha(){
    return $this-> fecha;
  }
  public function getActiva(){
    return $this-> activa;
  }

  //SETTERS

  public function SetTitulo($titulo){
    $this-> titulo = $título;
  }
  public function SetTexto($texto){
    $this-> texto = $texto;
  }
  public function SetActiva($activa){
    $this-> activa = $activa;
  }
}
 ?>
