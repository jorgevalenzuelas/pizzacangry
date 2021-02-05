<?php

//El iniciador es el que se encargara de cargar todos los archivos 
//necesarios de la misma carpeta app y este mismo se la pasara al index
error_reporting(0);

//Cargamos librerias
require_once 'config/Configurar.php';

require_once 'helpers/url_helper.php';
/*
require_once 'librerias/ConexionBD.php';
require_once 'librerias/Controlador.php';
require_once 'librerias/Core.php';
*/

//Usamos el Autoload para no tener que anidar librerias como arriba
//esto es por si el sistema se hace robusto...

//Autoload php
spl_autoload_register(function($nombreClase){

	require_once 'core/' . $nombreClase . '.php';

});

?>