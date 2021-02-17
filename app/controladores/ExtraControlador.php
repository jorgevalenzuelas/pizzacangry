<?php
session_start();

if ($_SESSION["cve_usuario"] == "")
{
	header("Location:Login");
}
else
{

	//Heredamos Controlador para poder tener acceso al método modelo y método vista
	class Extra extends Controlador
	{
		
		public function __construct()
		{

			$this->ExtraModelo = $this->modelo('ExtraModelo');

		}



		//Todo controlador debe tener un metodo index
		public function index()
		{
			$this->vista('extra/Extra');
		}



		public function consultar()
		{
			$data = $this->ExtraModelo->consultar($_POST);

			$envioDatos["arrayDatos"] = $data;

			echo json_encode($envioDatos);
		}

		public function guardarExtra()
		{
			$datosCompletos = $this->validarDatosVaciosExtraGuardar($_POST);
			if ($datosCompletos == "vacio")
			{
				$status = "error";
				$msg = "Favor de revisar el formulario, hay campos requeridos vacios.";
			}
			else
			{
				//Preparamos en un array los datos que enviaremos a la BD
				$datosExtra =  array (
									ban                => 1,
									cve_extra   => $_POST["cve_extra"],
									nombre_extra => $_POST["nombre_extra"],
									costo_extra => $_POST["costo_extra"],
									precio_extra => $_POST["precio_extra"],
									cvetamano_extra => $_POST["cvetamano_extra"],
							     	cveusuario_accion  => $_SESSION["cve_usuario"]
							     );
				
				$respuesta = $this->ExtraModelo->guardarExtra($datosExtra);

				
				if ($respuesta == true)
				{
					$msg = "Tamaño guardado con Éxito.";
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



		public function validarDatosVaciosExtraGuardar($dataPost)
		{
			if(empty($dataPost["nombre_extra"]) || !trim($dataPost["nombre_extra"])){ $status = "vacio"; }
			else if(empty($dataPost["costo_extra"]) || !trim($dataPost["costo_extra"])){ $status = "vacio"; }
			else if(empty($dataPost["precio_extra"]) || !trim($dataPost["precio_extra"])){ $status = "vacio"; }
			else if(empty($dataPost["cvetamano_extra"]) || !trim($dataPost["cvetamano_extra"])){ $status = "vacio"; }
			else{
				$status = "completo";
			}

			return $status;
		}



		public function bloquearExtra()
		{
			$datosExtra =  array (
								ban                => $_POST["ban"],
								cve_extra   => $_POST["cve_extra"],
								cveusuario_accion  => $_SESSION["cve_usuario"]
						     );

			$respuesta = $this->ExtraModelo->bloquearExtra($datosExtra);

			if ($respuesta == true)
			{
				if ($datosExtra['ban'] == 2)
				{
					$msg = "Tamaño bloqueado.";
				}else{
					$msg = "Tamaño desbloqueado.";
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