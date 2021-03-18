<?php
$destinatario = "dobidah863@iconmle.com";
$asunto = "Prueba de Mail";
$mensaje = "Esto es una prueba";

$exito = mail($destinatario, $asunto, $mensaje);

if ($exito) {
  echo "Email Enviado";
} else {
  echo "Email Fallido";
}
?>
