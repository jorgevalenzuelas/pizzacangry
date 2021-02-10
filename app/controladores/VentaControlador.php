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

		public function guardarBebida()
		{
			$datosCompletos = $this->validarDatosVaciosBebidaGuardar($_POST);
			if ($datosCompletos == "vacio")
			{
				$status = "error";
				$msg = "Favor de revisar el formulario, hay campos requeridos vacios.";
			}
			else
			{
				//Preparamos en un array los datos que enviaremos a la BD
				$datosBebida =  array (
									ban                => 1,
									cve_bebida   => $_POST["cve_bebida"],
									nombre_bebida => $_POST["nombre_bebida"],
									costo_bebida => $_POST["costo_bebida"],
									precio_bebida => $_POST["precio_bebida"],
									stock_bebida => $_POST["stock_bebida"],
									cveunidadmedia_bebida => $_POST["cveunidadmedia_bebida"],
							     	cveusuario_accion  => $_SESSION["cve_usuario"]
							     );
				
				$respuesta = $this->BebidaModelo->guardarBebida($datosBebida);

				
				if ($respuesta == true)
				{
					$msg = "Bebida guardado con Éxito.";
					$status = "success";
				}
				else
				{
					$msg = "Hubo un error al guardar el registro.";
					$status = "error";
				}
				
			}

			
			$envioDatos["status"] = $status;
			$envioDatos["msg"] = $msg;
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