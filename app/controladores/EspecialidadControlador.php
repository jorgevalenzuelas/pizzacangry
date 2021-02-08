<?php
session_start();

if ($_SESSION["cve_usuario"] == "")
{
	header("Location:Login");
}
else
{

	//Heredamos Controlador para poder tener acceso al método modelo y método vista
	class Especialidad extends Controlador
	{
		
		public function __construct()
		{

			$this->EspecialidadModelo = $this->modelo('EspecialidadModelo');

		}



		//Todo controlador debe tener un metodo index
		public function index()
		{
			$this->vista('especialidad/Especialidad');
		}



		public function consultar()
		{
			$data = $this->EspecialidadModelo->consultar($_POST);

			$envioDatos["arrayDatos"] = $data;

			echo json_encode($envioDatos);
		}

		public function guardarEspecialidad()
		{
			$datosCompletos = $this->validarDatosVaciosEspecialidadGuardar($_POST);
			if ($datosCompletos == "vacio")
			{
				$status = "error";
				$msg = "Favor de revisar el formulario, hay campos requeridos vacios.";
			}
			else
			{
				//Preparamos en un array los datos que enviaremos a la BD
				$datosEspecialidad =  array (
									ban                => 1,
									cve_especialidad   => $_POST["cve_especialidad"],
									nombre_especialidad => $_POST["nombre_especialidad"],
									costo_especialidad => $_POST["costo_especialidad"],
									precio_especialidad => $_POST["precio_especialidad"],
									descripcion_especialidad => $_POST["descripcion_especialidad"],
									cvetamano_especialidad => $_POST["cvetamano_especialidad"],
							     	cveusuario_accion  => $_SESSION["cve_usuario"]
							     );
				
				$respuesta = $this->EspecialidadModelo->guardarEspecialidad($datosEspecialidad);

				
				if ($respuesta == true)
				{
					$msg = "Especialidad guardado con Éxito.";
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



		public function validarDatosVaciosEspecialidadGuardar($dataPost)
		{
			if(empty($dataPost["nombre_especialidad"]) || !trim($dataPost["nombre_especialidad"])){ $status = "vacio"; }
			else if(empty($dataPost["costo_especialidad"]) || !trim($dataPost["costo_especialidad"])){ $status = "vacio"; }
			else if(empty($dataPost["precio_especialidad"]) || !trim($dataPost["precio_especialidad"])){ $status = "vacio"; }
			else if(empty($dataPost["descripcion_especialidad"]) || !trim($dataPost["descripcion_especialidad"])){ $status = "vacio"; }
			else if(empty($dataPost["cvetamano_especialidad"]) || !trim($dataPost["cvetamano_especialidad"])){ $status = "vacio"; }
			else{
				$status = "completo";
			}

			return $status;
		}



		public function bloquearEspecialidad()
		{
			$datosEspecialidad =  array (
								ban                => $_POST["ban"],
								cve_especialidad   => $_POST["cve_especialidad"],
								cveusuario_accion  => $_SESSION["cve_usuario"]
						     );

			$respuesta = $this->EspecialidadModelo->bloquearEspecialidad($datosEspecialidad);

			if ($respuesta == true)
			{
				if ($datosEspecialidad['ban'] == 2)
				{
					$msg = "Especialidad bloqueado.";
				}else{
					$msg = "Especialidad desbloqueado.";
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