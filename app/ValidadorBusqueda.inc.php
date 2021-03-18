<?php
class ValidadorBusqueda {
  public static function EliminarEspacios($texto){
    $texto = str_replace(' ', '', $texto);
    return $texto;
  }
}
?>
