<?php

//Heredamos Controlador para poder tener acceso al método modelo y método vista
class ErrorPagina extends Controlador
{
	
	public function __construct()
	{

		//$this->loginModelo = $this->modelo('LoginModelo');

	}

	//Todo controlador debe tener un metodo index
	public function index()
	{

		$this->vista('error/Error404');

	}

}


?>