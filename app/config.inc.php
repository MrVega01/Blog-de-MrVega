<?php
//INFORMACION BD
define('NOMBRE_SERVIDOR', 'localhost');
define('NOMBRE_USUARIO', 'root');
define('PASSWORD', '');
define('NOMBRE_BD', 'blog');

//DIRECCIONES URL
define('LOCALHOST', 'http://localhost/blog');
define('ROUTE_INFO', LOCALHOST.'/informacion');
define('ROUTE_SIGNUP', LOCALHOST.'/signup');
define('ROUTE_CORRECT_SIGNUP', LOCALHOST.'/registro-correcto');
define('ROUTE_LOGIN', LOCALHOST.'/login');
define('ROUTE_LOGOUT', LOCALHOST.'/logout');
define('ROUTE_ENTRADA', LOCALHOST.'/entrada');
define('ROUTE_DASHBOARD', LOCALHOST.'/dashboard');
define('ROUTE_DASHBOARD_ENTRADAS', ROUTE_DASHBOARD.'/entradas');
define('ROUTE_DASHBOARD_COMENTARIOS', ROUTE_DASHBOARD.'/comentarios');
define('ROUTE_DASHBOARD_AJUSTES', ROUTE_DASHBOARD.'/ajustes');
define('ROUTE_NEW_ENTRADA', LOCALHOST.'/nueva-entrada');
define('ROUTE_DELETE_ENTRADA', LOCALHOST.'/borrar-entrada');
define('ROUTE_EDIT_ENTRADA', LOCALHOST.'/editar-entrada');
define('ROUTE_RECOVER_PASSWORD', LOCALHOST.'/recuperar-contrasena');
define('ROUTE_GENERATE_SECRET_URL', LOCALHOST.'/generar-url');
define('ROUTE_NEW_PASSWORD', LOCALHOST.'/nueva-contrasena');
define('ROUTE_CORRECT_PASSWORD_UPDATE', LOCALHOST.'/contrasena-actualizada');
define('ROUTE_REQUEST_SUCCESS', LOCALHOST.'/peticion-enviada');
define('ROUTE_SEARCH', LOCALHOST.'/buscar');
define('ROUTE_CONFIRMED_ACCOUNT', LOCALHOST.'/cuenta-confirmada');

define('ROUTE_MAIL_TEST', LOCALHOST.'/mail');

//RESOURCES
define('ROUTE_CSS', LOCALHOST.'/css/');
define('ROUTE_JS', LOCALHOST.'/js/');
define('ROUTE_ROOT', realpath(__DIR__) . "/..");

//404
define('ROUTE_404', LOCALHOST. '/vistas/');
 ?>
