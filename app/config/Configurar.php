<?php

//Ruta de la aplicación
//define ('RUTA_APP', dirname(dirname(__FILE__)));
define ('RUTA_APP', $_SERVER['DOCUMENT_ROOT'] . "/pizzacangry/app/");

define ('RUTA_PUBLIC', $_SERVER['DOCUMENT_ROOT'] . "/pizzacangry/public");

define ('RUTA_URL', 'http://' . $_SERVER[HTTP_HOST] . '/pizzacangry/');

define ('NOMBRE_SITIO', 'Pizza Los Cangry');

?>