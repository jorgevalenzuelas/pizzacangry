<?php
session_start();

if ($_SESSION["cve_usuario"] == "")
{
	header("Location:Login");
}
else
{

	//Heredamos Controlador para poder tener acceso al método modelo y método vista
	class Unidadmedida extends Controlador
	{
		
		public function __construct()
		{

			$this->UnidadmedidaModelo = $this->modelo('UnidadmedidaModelo');

		}



		//Todo controlador debe tener un metodo index
		public function index()
		{
			$this->vista('unidadmedida/Unidadmedida');
		}



		public function consultar()
		{
			$data = $this->UnidadmedidaModelo->consultar($_POST);

			$envioDatos["arrayDatos"] = $data;

			echo json_encode($envioDatos);
		}

		public function guardarUnidadmedida()
		{
			$datosCompletos = $this->validarDatosVaciosUnidadmedidaGuardar($_POST);
			if ($datosCompletos == "vacio")
			{
				$status = "error";
				$msg = "Favor de revisar el formulario, hay campos requeridos vacios.";
			}
			else
			{
				//Preparamos en un array los datos que enviaremos a la BD
				$datosUnidadmedida =  array (
									ban                => 1,
									cve_unidadmedida   => $_POST["cve_unidadmedida"],
									nombre_unidadmedida => $_POST["nombre_unidadmedida"],
							     	cveusuario_accion  => $_SESSION["cve_usuario"]
							     );
				
				$respuesta = $this->UnidadmedidaModelo->guardarUnidadmedida($datosUnidadmedida);

				
				if ($respuesta == true)
				{
					$msg = "Unidad medida guardado con Éxito.";
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



		public function validarDatosVaciosUnidadmedidaGuardar($dataPost)
		{
			if(empty($dataPost["nombre_unidadmedida"]) || !trim($dataPost["nombre_unidadmedida"])){ $status = "vacio"; }
			else{
				$status = "completo";
			}

			return $status;
		}



		public function bloquearUnidadmedida()
		{
			$datosUnidadmedida =  array (
								ban                => $_POST["ban"],
								cve_unidadmedida   => $_POST["cve_unidadmedida"],
								cveusuario_accion  => $_SESSION["cve_usuario"]
						     );

			$respuesta = $this->UnidadmedidaModelo->bloquearUnidadmedida($datosUnidadmedida);

			if ($respuesta == true)
			{
				if ($datosUnidadmedida['ban'] == 2)
				{
					$msg = "Unidad de medida bloqueado.";
				}else{
					$msg = "Unidad de medida desbloqueado.";
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