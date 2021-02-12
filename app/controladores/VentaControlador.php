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

			$this->VentaModelo = $this->modelo('VentaModelo');

		}



		//Todo controlador debe tener un metodo index
		public function index()
		{
			$this->vista('venta/Venta');
		}


		public function formPizzaIngrediente()
		{
			$this->vista('venta/formPizzaIngrediente');
		}

		public function formPizzaIngredientePaquete()
		{
			$this->vista('venta/formPizzaIngredientePaquete');
		}

		public function consultarProductos()
		{
			$data = $this->VentaModelo->consultarProductos($_POST);

			$envioDatos["arrayDatos"] = $data;

			echo json_encode($envioDatos);
		}

		public function generarFolio()
		{
				//Preparamos en un array los datos que enviaremos a la BD
				$datosFolio =  array (
									ban                => $_POST["ban"],
									folo_venta                => $_POST["folo_venta"],
							     	cveusuario_accion  => $_SESSION["cve_usuario"]
							     );
				
				$respuesta = $this->VentaModelo->generarFolio($datosFolio);

				$envioDatos["arrayDatos"] = $respuesta;

				echo json_encode($envioDatos);
		}



		public function validarDatosVaciosBebidaGuardar($dataPost)
		{
			if(empty($dataPost["nombre_bebida"]) || !trim($dataPost["nombre_bebida"])){ $status = "vacio"; }
			else if(empty($dataPost["costo_bebida"]) || !trim($dataPost["costo_bebida"])){ $status = "vacio"; }
			else if(empty($dataPost["precio_bebida"]) || !trim($dataPost["precio_bebida"])){ $status = "vacio"; }
			else if(empty($dataPost["stock_bebida"]) || !trim($dataPost["stock_bebida"])){ $status = "vacio"; }
			else if(empty($dataPost["cveunidadmedia_bebida"]) || !trim($dataPost["cveunidadmedia_bebida"])){ $status = "vacio"; }
			else{
				$status = "completo";
			}

			return $status;
		}



		public function bloquearBebida()
		{
			$datosBebida =  array (
								ban                => $_POST["ban"],
								cve_bebida   => $_POST["cve_bebida"],
								cveusuario_accion  => $_SESSION["cve_usuario"]
						     );

			$respuesta = $this->BebidaModelo->bloquearBebida($datosBebida);

			if ($respuesta == true)
			{
				if ($datosBebida['ban'] == 2)
				{
					$msg = "Bebida bloqueado.";
				}else{
					$msg = "Bebida desbloqueado.";
				}
				$status = "success";
			}
			else
			{
				//Este error se presenta por un error en el query
				$msg = "Hubo un error al bloquear el registro.";
				$status = "error";
			}

			$envioDatos["status"] = $status;
			$envioDatos["msg"] = $msg;
			echo json_encode($envioDatos);
		}
		
	}

}


?>