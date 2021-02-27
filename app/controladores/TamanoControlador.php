<?php
session_start();

if ($_SESSION["cve_usuario"] == "")
{
	header("Location:Login");
}
else
{

	//Heredamos Controlador para poder tener acceso al método modelo y método vista
	class Tamano extends Controlador
	{
		
		public function __construct()
		{
			$this->TamanoModelo = $this->modelo('TamanoModelo');
		}

		//Todo controlador debe tener un metodo index
		public function index()
		{
			$this->vista('tamano/Tamano');
		}

		public function consultar()
		{
			$data = $this->TamanoModelo->consultar($_POST);
			$envioDatos["arrayDatos"] = $data;
			echo json_encode($envioDatos);
		}

		public function guardarTamano()
		{
			$datosCompletos = $this->validarDatosVaciosTamanoGuardar($_POST);
			if ($datosCompletos == "vacio")
			{
				$status = "error";
				$msg = "Favor de revisar el formulario, hay campos requeridos vacios.";
			}
			else
			{
				//Preparamos en un array los datos que enviaremos a la BD
				$datosTamano =  array (
									ban                => 1,
									cve_tamano   => $_POST["cve_tamano"],
									nombre_tamano => $_POST["nombre_tamano"],
							     	cveusuario_accion  => $_SESSION["cve_usuario"]
							     );
				
				$respuesta = $this->TamanoModelo->guardarTamano($datosTamano);

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

		public function validarDatosVaciosTamanoGuardar($dataPost)
		{
			if(empty($dataPost["nombre_tamano"]) || !trim($dataPost["nombre_tamano"])){ $status = "vacio"; }
			else{
				$status = "completo";
			}
			return $status;
		}

		public function bloquearTamano()
		{
			$datosTamano =  array (
								ban                => $_POST["ban"],
								cve_tamano   => $_POST["cve_tamano"],
								cveusuario_accion  => $_SESSION["cve_usuario"]
						     );

			$respuesta = $this->TamanoModelo->bloquearTamano($datosTamano);

			if ($respuesta == true)
			{
				if ($datosTamano['ban'] == 2)
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