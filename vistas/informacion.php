<?php
$title = "Acerca de Blog de MrVega";
include_once "templates/header.inc.php";
include_once "templates/navbar.inc.php";
?>
<div class="container-xl mb-4">
  <div class="card card-body">
    <h1 class="text-center display-4">Funciones de la página</h2>
    <h5 class="text-center mt-5 mb-3"><strong>Sesión de cuentas <i class="fas fa-user-circle"></i></strong></h5>
    <p class="text-justify mx-2">Puedes registrarte en la página, solo necesitas un correo y una contraseña personal, tener una cuenta
te proporcionará acceso a todas las herramientas y funciones de la página, como gestionar los datos de la misma, personalizar tu
imagen dentro del blog y poder crear contenido dentro del mismo.</p>
    <h5 class="text-center mt-3 mb-3"><strong>Publicar entradas <i class="fas fa-newspaper"></i></strong></h5>
    <p class="text-justify mx-2">Para publicar entradas, es necesario crear una cuenta previamente y haber ingresado en esta.
Puedes publicar entradas de lo que desees, ingresando un título y un contenido lo suficientemente grande para que sea válido,
dentro podrás utilizar cualquier carácter especial e incluso emoticones, aunque no se recomienda hacer esto en el título,
debido a que este se utiliza para crear una URL dinámica y estos carácteres pueden traer problemas.</p>
    <p class="text-justify mx-2">Puedes elegir entre hacer tu entrada pública o guardarla como un borrador, esto viene perfecto
para guardar una entrada no completada y simplemente guardarla como un borrador, también
puedes convertir las entradas públicas a borrador y viceversa. Puedes hacer estas funciones en el gestor de entradas, dentro también
tienes la opción de eliminarlas.</p>
    <h5 class="text-center mt-3 mb-3"><strong>Crear comentarios <i class="fas fa-comments"></i></strong></h5>
    <p class="text-justify mx-2">Al entrar a una entrada, tienes la opción de aportar comentarios dentro de la misma, útil para
compartir ideas con el autor de la misma o con otros usuarios que estén comentando. Para realizar comentarios, es necesario haber
ingresado a tu cuenta previamente.</p>
    <h5 class="text-center mt-3 mb-3"><strong>Realizar busquedas <i class="fas fa-search"></i></strong></h5>
    <p class="text-justify mx-2">Con la busqueda, tienes la posiblidad de encontrar la entrada o usuario que desees, esto con
la comodidad de tenerla en todo momento en la barra de navegación, por lo que podrás utilizarla en cualquier lugar de la página
en que estés. Al realizar una busqueda, tienes la opción de tener resultados más precisos usando la busqueda avanzada, con la cual
podrás elegir especificamente lo que buscas.</p>
    <h5 class="text-center mt-3 mb-3"><strong>Diseño responsive <i class="fas fa-palette"></i></strong></h5>
    <p class="text-justify mx-2">Con esta función, es posible acceder a la página desde cualquier resolución de pantalla sin que
haya ningún problema, lo que significa que la página es accesible desde teléfonos, tablets y computadores, independientemente de
la resolución de sus pantallas.</p>
    <h1 class="text-center my-3 display-4">Funciones deshabilitadas</h2>
    <h5 class="text-center mt-3 mb-3"><strong>Confirmación de cuentas <i class="fas fa-user-shield"></i></strong></h5>
    <p class="text-justify mx-2">Al crear una cuenta, era posible enviar un correo de confirmación al email que se ha proporcionado en
el registro, de forma que era necesario verificar la cuenta para poder tener acceso a la misma. Esto para evitar la posible creación
de cuentas falsas masivas y para futuras funciones de seguridad que podrían ser implementadas en la página. Sin embargo, esta función
fue excluida a último momento de la página debido a limitaciones del hosting, lo que no permitía el envío de estos correos y hacía
imposible su habilitación</p>
    <h5 class="text-center mt-3 mb-3"><strong>Recuperación de contraseña <i class="fas fa-key"></i></strong></h5>
    <p class="text-justify mx-2">Esta función permitía la recuperación de tu contraseña en caso de que haya sido olvidada, solo
necesitabas proporcionar el email que utilizaste al momento del registro y se enviaría un correo de recuperación,
en el cual se incluía un enlace con el que podías asignar una nueva contraseña en unos muy cortos pasos. Debido a que esta función
requería de envíos de correos, no pudo ser habilitada, debido a que el hosting no ofrecía este servicio.</p>
    <h1 class="text-center mt-3 display-4">Contacta con el desarrollador</h2>
      <div class="row mt-5 mb-3">
        <div class="col-1"></div>
        <div class="col-5">
          <p class="text-center contact"><a href="https://www.facebook.com/Space.Epic.Uwu"><i class="fab fa-facebook"></i></a></p>
        </div>
        <div class="col-5">
          <p class="text-center contact"><a class="discord" href="https://discord.gg/K3e3W9DrRB"><i class="fab fa-discord"></i></a></p>
        </div>
      </div>
  </div>
</div>
