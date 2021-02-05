<?php
session_start();

if ($_SESSION["cve_usuario"] == "")
{
	header("Location:Login");
}
else
{

	//Heredamos Controlador para poder tener acceso al método modelo y método vista
	class Puesto extends Controlador
	{
		
		public function __construct()
		{

			$this->puestoModelo = $this->modelo('PuestoModelo');

		}



		//Todo controlador debe tener un metodo index
		public function index()
		{
			$this->vista('puesto/Puesto');
		}



		public function consultar()
		{
			$data = $this->puestoModelo->consultar($_POST);

			$envioDatos["arrayDatos"] = $data;

			echo json_encode($envioDatos);
		}



		public function formPuesto()
		{

			$this->vista('puesto/formPuestos', $datos);
		}



		public function guardarPuesto()
		{
			$datosCompletos = $this->validarDatosVaciosPuestoGuardar($_POST);

			if ($datosCompletos == "vacio")
			{
				$status = "error";
				$msg = "Favor de revisar el formulario, hay campos requeridos vacios.";
			}
			else
			{
				//Preparamos en un array los datos que enviaremos a la BD
				$cve_puesto = (empty($cve_puesto)) ? $_POST["txtcvePuesto"] : 0 ;

				$datosPuesto =  array (
									ban               => 1,
									nombrePuesto      => $_POST["txtNombrePuesto"],
									cve_puesto        => $cve_puesto,
							     	cveusuario_accion => $_SESSION["cve_usuario"]
							     );
				
				$respuesta = $this->puestoModelo->guardarPuesto($datosPuesto);

				
				if ($respuesta == true)
				{
					$msg = "Puesto guardado con Éxito.";
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



		public function validarDatosVaciosPuestoGuardar($dataPost)
		{
			if(empty($dataPost["txtNombrePuesto"]) || !trim($dataPost["txtNombrePuesto"])){ $status = "vacio"; }
			else{
				$status = "completo";
			}

			return $status;
		}



		public function bloquearPuesto()
		{
			$datosPuesto =  array (
								ban                 => $_POST["ban"],
								cve_puesto          => $_POST["cve_puesto"],
								cveusuario_accion   => $_SESSION["cve_usuario"]
						     );

			$respuesta = $this->puestoModelo->bloquearPuesto($datosPuesto);

			if ($respuesta == true)
			{
				if ($datosPuesto['ban'] == 2)
				{
					$msg = "Puesto bloqueado.";
				}else{
					$msg = "Puesto desbloqueado.";
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