<?php
session_start();

if ($_SESSION["cve_usuario"] == "")
{
	header("Location:Login");
}
else
{

	//Heredamos Controlador para poder tener acceso al método modelo y método vista
	class Cliente extends Controlador
	{
		
		public function __construct()
		{

			$this->clienteModelo = $this->modelo('ClienteModelo');

		}



		//Todo controlador debe tener un metodo index
		public function index()
		{
			$this->vista('cliente/Cliente');
		}



		public function consultar()
		{
			$data = $this->clienteModelo->consultar($_POST);

			$envioDatos["arrayDatos"] = $data;

			echo json_encode($envioDatos);
		}



		public function formCliente()
		{

			$this->vista('cliente/formCliente', $datos);
		}



		public function guardarCliente()
		{
			$datosCompletos = $this->validarDatosVaciosClienteGuardar($_POST);

			if ($datosCompletos == "vacio")
			{
				$status = "error";
				$msg = "Favor de revisar el formulario, hay campos requeridos vacios.";
			}
			else
			{
				//Preparamos en un array los datos que enviaremos a la BD
				$cve_cliente = (empty($cve_cliente)) ? $_POST["txtcveCliente"] : 0 ;

				$datosCliente =  array (
									ban               => 1,
									nombreCliente      => $_POST["txtNombreCliente"],
									direccionCliente      => $_POST["txtDireccionCliente"],
									cve_cliente        => $cve_cliente,
							     	cveusuario_accion => $_SESSION["cve_usuario"]
							     );
				
				$respuesta = $this->clienteModelo->guardarCliente($datosCliente);

				
				if ($respuesta == true)
				{
					$msg = "Cliente guardado con Éxito.";
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

		public function guardarClienteNuevo()
		{
			$datosCompletos = $this->validarDatosVaciosClienteGuardarNuevo($_POST);

			if ($datosCompletos == "vacio")
			{
				$status = "error";
				$msg = "Favor de revisar el formulario, hay campos requeridos vacios.";
			}
			else
			{
				//Preparamos en un array los datos que enviaremos a la BD
				$cve_cliente = (empty($cve_cliente)) ? $_POST["txtcveClienteNuevo"] : 0 ;

				$datosClienteNuevo =  array (
									ban               => 1,
									nombreCliente      => $_POST["txtNombreClienteNuevo"],
									cve_cliente        => $cve_cliente,
							     	cveusuario_accion => $_SESSION["cve_usuario"]
							     );
				
				$respuesta = $this->clienteModelo->guardarCliente($datosClienteNuevo);

				
				if ($respuesta == true)
				{
					$msg = "Cliente guardado con Éxito.";
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

		public function validarDatosVaciosClienteGuardar($dataPost)
		{
			if(empty($dataPost["txtNombreCliente"]) || !trim($dataPost["txtNombreCliente"])){ $status = "vacio"; }
			else if(empty($dataPost["txtDireccionCliente"]) || !trim($dataPost["txtDireccionCliente"])){ $status = "vacio"; }
			else{
				$status = "completo";
			}

			return $status;
		}

		public function validarDatosVaciosClienteGuardarNuevo($dataPost)
		{
			if(empty($dataPost["txtNombreClienteNuevo"]) || !trim($dataPost["txtNombreClienteNuevo"])){ $status = "vacio"; }
			else{
				$status = "completo";
			}

			return $status;
		}



		public function bloquearCliente()
		{
			$datosCliente =  array (
								ban                 => $_POST["ban"],
								cve_cliente          => $_POST["cve_cliente"],
								cveusuario_accion   => $_SESSION["cve_usuario"]
						     );

			$respuesta = $this->clienteModelo->bloquearCliente($datosCliente);

			if ($respuesta == true)
			{
				if ($datosCliente['ban'] == 2)
				{
					$msg = "Cliente bloqueado.";
				}else{
					$msg = "Cliente desbloqueado.";
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