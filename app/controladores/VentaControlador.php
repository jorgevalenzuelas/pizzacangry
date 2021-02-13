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

		public function GuardarVenta()
		{
				//Preparamos en un array los datos que enviaremos a la BD
				$datosVenta =  array (
									ban                => 1,
									cve_deventa   => $_POST["cve_deventa"],
									folioventa_deventa   => $_POST["folioventa_deventa"],
									cvema_deventa => $_POST["cvema_deventa"],
									cantidad_deventa => $_POST["cantidad_deventa"],
									preciounitario_deventa => $_POST["preciounitario_deventa"],
									cveproducto_deventa => $_POST["cveproducto_deventa"],
									deingredientes => $_POST["deingredientes"],
							     	cveusuario_accion  => $_SESSION["cve_usuario"]
							     );
				
				$respuesta = $this->VentaModelo->guardarVenta($datosVenta);
				
				

				if ($respuesta == true)
				{
					$msg = "Registro de venta con exito.";
					$status = "success";
				}
				else
				{
					$msg = "Hubo un error al guardar el registro.";
					$status = "error";
				}
				
			

			
			$envioDatos["status"] = $status;
			$envioDatos["msg"] = $msg;
			echo json_encode($envioDatos);
			
		}

		public function validarDatosVaciosVentaGuardar($dataPost)
		{
			if(empty($dataPost["folioventa_deventa"]) || !trim($dataPost["folioventa_deventa"])){ $status = "vacio"; }
			else if(empty($dataPost["cvema_deventa"]) || !trim($dataPost["cvema_deventa"])){ $status = "vacio"; }
			else if(empty($dataPost["cantidad_deventa"]) || !trim($dataPost["cantidad_deventa"])){ $status = "vacio"; }
			else if(empty($dataPost["preciounitario_deventa"]) || !trim($dataPost["preciounitario_deventa"])){ $status = "vacio"; }
			else if(empty($dataPost["cveproducto_deventa"]) || !trim($dataPost["cveproducto_deventa"])){ $status = "vacio"; }
			else if(empty($dataPost["deingredientes"]) || !trim($dataPost["deingredientes"])){ $status = "vacio"; }
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