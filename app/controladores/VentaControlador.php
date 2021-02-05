<?php
session_start();

if ($_SESSION["cve_usuario"] == "")
{
	header("Location:Login");
}
else
{

	//Heredamos Controlador para poder tener acceso al método modelo y método vista
	class Venta extends Controlador
	{
		
		public function __construct()
		{

			$this->ventaModelo = $this->modelo('VentaModelo');

		}

		

		//Todo controlador debe tener un metodo index
		public function index()
		{
			$this->vista('venta/Puntoventa');
		}

	}

}


?>