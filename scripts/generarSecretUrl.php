<?php
include_once "app/RepositorioRecuperarPassword.inc.php";
include_once "app/Redireccion.inc.php";

  function sa($longitud){
  $caracteres='1234567890qwertyuiopasdfghjklzxcvbnnmQWERTYUIOPASDFGHJKLZXCVBNM-';
  $numerocaracteres=strlen($caracteres);
  $string="";

  for ($i= 0; $i < $longitud; $i++) {
    $string .= $caracteres[rand(0, $numerocaracteres - 1)];
  }
  return $string;
}
?>
