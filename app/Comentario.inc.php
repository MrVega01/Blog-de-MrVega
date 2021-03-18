<?php
class Comentario{
  private $id;
  private $autor_id;
  private $entrada_id;
  private $titulo;
  private $texto;
  private $fecha;

  public function __construct($id, $autor_id, $entrada_id, $titulo, $texto, $fecha){
      $this-> id = $id;
      $this-> autor_id = $autor_id;
      $this-> entrada_id = $entrada_id;
      $this-> titulo = $titulo;
      $this-> texto = $texto;
      $this-> fecha = $fecha;
  }

  public function getId(){
    return $this-> id;
  }
  public function getAutorId(){
    return $this-> autor_id;
  }
  public function getEntradaId(){
    return $this-> entrada_id;
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

  //SETTERS

  public function setTitulo($titulo){
    $this-> titulo = $titulo;
  }
  public function setTexto($texto){
    $this-> texto = $texto;
  }
}
 ?>
