<?php
session_start();

if ($_SESSION["cve_usuario"] == "")
{
	header("Location:Login");
}
else
{

	//Heredamos Controlador para poder tener acceso al método modelo y método vista
	class Sucursal extends Controlador
	{
		
		public function __construct()
		{

			$this->sucursalModelo = $this->modelo('SucursalModelo');

		}



		//Todo controlador debe tener un metodo index
		public function index()
		{
			$this->vista('sucursal/Sucursal');
		}



		public function consultar()
		{
			$data = $this->sucursalModelo->consultar($_POST);

			$envioDatos["arrayDatos"] = $data;

			echo json_encode($envioDatos);
		}



		public function formSucursal()
		{

			$this->vista('sucursal/formSucursal', $datos);
		}



		public function guardarSucursal()
		{
			$datosCompletos = $this->validarDatosVaciosSucursalGuardar($_POST);

			if ($datosCompletos == "vacio")
			{
				$status = "error";
				$msg = "Favor de revisar el formulario, hay campos requeridos vacios.";
			}
			else
			{
				//Preparamos en un array los datos que enviaremos a la BD
				$cve_sucursal = (empty($cve_sucursal)) ? $_POST["txtcveSucursal"] : 0 ;

				$datosSucursal =  array (
									ban                    => 1,
									nombreSucursal         => $_POST["txtNombreSucursal"],
									direccionSucursal      => $_POST["txtDireccion"],
									coloniaSucursal        => $_POST["txtColonia"],
									telefonoSucursal       => $_POST["txtTelefono"],
									representanteSucursal  => $_POST["txtRepresentante"],
									tipoSucursal           => $_POST["cmbTipo"],
									cve_sucursal           => $cve_sucursal,
							     	cveusuario_accion      => $_SESSION["cve_usuario"]
							     );
				
				$respuesta = $this->sucursalModelo->guardarSucursal($datosSucursal);

				
				if ($respuesta == true)
				{
					$msg = "Sucursal guardada con Éxito.";
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



		public function validarDatosVaciosSucursalGuardar($dataPost)
		{
			if(empty($dataPost["txtNombreSucursal"]) || !trim($dataPost["txtNombreSucursal"])){ $status = "vacio"; }
			elseif(empty($dataPost["txtDireccion"]) || !trim($dataPost["txtDireccion"])){ $status = "vacio"; }
			elseif(empty($dataPost["txtColonia"]) || !trim($dataPost["txtColonia"])){ $status = "vacio"; }
			else{
				$status = "completo";
			}

			return $status;
		}



		public function bloquearSucursal()
		{
			$datosSucursal =  array (
								ban                 => $_POST["ban"],
								cve_sucursal         => $_POST["cve_sucursal"],
								cveusuario_accion   => $_SESSION["cve_usuario"]
						     );

			$respuesta = $this->sucursalModelo->bloquearSucursal($datosSucursal);

			if ($respuesta == true)
			{
				if ($datosSucursal['ban'] == 2)
				{
					$msg = "Sucursal bloqueada.";
				}else{
					$msg = "Sucursal desbloqueada.";
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