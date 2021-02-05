<?php
session_start();

if ($_SESSION["cve_usuario"] == "")
{
	header("Location:Login");
}
else
{

	//Heredamos Controlador para poder tener acceso al método modelo y método vista
	class Bases extends Controlador
	{
		
		public function __construct()
		{

			$this->basesModelo = $this->modelo('BasesModelo');

		}



		//Todo controlador debe tener un metodo index
		public function index()
		{
			$this->vista('bases/Bases');
		}



		public function consultar()
		{
			$data = $this->basesModelo->consultar($_POST);

			$envioDatos["arrayDatos"] = $data;

			echo json_encode($envioDatos);
		}



		public function guardarBase()
		{
			$datosCompletos = $this->validarDatosVaciosBaseGuardar($_POST);

			if ($datosCompletos == "vacio")
			{
				$status = "error";
				$msg = "Favor de revisar el formulario, hay campos requeridos vacios.";
			}
			else
			{
				//Preparamos en un array los datos que enviaremos a la BD
				$cve_base = (empty($cve_base)) ? $_POST["txtcveBase"] : 0 ;

				$datosBase =  array (
									ban                => 1,
									nombreBase         => $_POST["txtNombreBase"],
									depositoBase       => $_POST["txtDeposito"],
									existenciaBase     => $_POST["txtExistencias"],
									cve_base           => $cve_base,
							     	cveusuario_accion  => $_SESSION["cve_usuario"]
							     );
				
				$respuesta = $this->basesModelo->guardarBase($datosBase);

				
				if ($respuesta == true)
				{
					$msg = "Base guardada con Éxito.";
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



		public function validarDatosVaciosBaseGuardar($dataPost)
		{
			if(empty($dataPost["txtNombreBase"]) || !trim($dataPost["txtNombreBase"])){ $status = "vacio"; }
			elseif(empty($dataPost["txtDeposito"]) || !trim($dataPost["txtDeposito"])){ $status = "vacio"; }
			elseif(empty($dataPost["txtExistencias"]) || !trim($dataPost["txtExistencias"])){ $status = "vacio"; }
			else{
				$status = "completo";
			}

			return $status;
		}



		public function bloquearBase()
		{
			$datosBase =  array (
								ban                => $_POST["ban"],
								cve_base           => $_POST["cve_base"],
								cveusuario_accion  => $_SESSION["cve_usuario"]
						     );

			$respuesta = $this->basesModelo->bloquearBase($datosBase);

			if ($respuesta == true)
			{
				if ($datosBase['ban'] == 2)
				{
					$msg = "Base bloqueada.";
				}else{
					$msg = "Base desbloqueada.";
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