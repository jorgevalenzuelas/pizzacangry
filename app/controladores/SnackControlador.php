<?php
session_start();

if ($_SESSION["cve_usuario"] == "")
{
	header("Location:Login");
}
else
{

	//Heredamos Controlador para poder tener acceso al método modelo y método vista
	class Snack extends Controlador
	{
		
		public function __construct()
		{

			$this->SnackModelo = $this->modelo('SnackModelo');

		}



		//Todo controlador debe tener un metodo index
		public function index()
		{
			$this->vista('Snack/Snack');
		}



		public function consultar()
		{
			$data = $this->SnackModelo->consultar($_POST);

			$envioDatos["arrayDatos"] = $data;

			echo json_encode($envioDatos);
		}



		public function formSnack()
		{

			$this->vista('Snack/formSnack', $datos);
		}



		public function guardarSnack()
		{
			$datosCompletos = $this->validarDatosVaciosSnackGuardar($_POST);

			if ($datosCompletos == "vacio")
			{
				$status = "error";
				$msg = "Favor de revisar el formulario, hay campos requeridos vacios.";
			}
			else
			{
				//Preparamos en un array los datos que enviaremos a la BD
				$cve_snack = (empty($cve_snack)) ? $_POST["txtcveSnack"] : 0 ;

				$datosSnack =  array (
									ban                => 1,
									nombre_snack => $_POST["txtnombreSnack"],
									cve_snack   => $cve_snack,
							     	cveusuario_accion  => $_SESSION["cve_usuario"]
							     );
				
				$respuesta = $this->SnackModelo->guardarSnack($datosSnack);

				
				if ($respuesta == true)
				{
					$msg = "Snack guardado con Éxito.";
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



		public function validarDatosVaciosSnackGuardar($dataPost)
		{
			if(empty($dataPost["txtnombreSnack"]) || !trim($dataPost["txtnombreSnack"])){ $status = "vacio"; }
			else{
				$status = "completo";
			}

			return $status;
		}



		public function bloquearSnack()
		{
			$datosSnack =  array (
								ban                => $_POST["ban"],
								cve_snack   => $_POST["cve_snack"],
								cveusuario_accion  => $_SESSION["cve_usuario"]
						     );

			$respuesta = $this->SnackModelo->bloquearSnack($datosSnack);

			if ($respuesta == true)
			{
				if ($datosSnack['ban'] == 2)
				{
					$msg = "Snack bloqueado.";
				}else{
					$msg = "Snack desbloqueado.";
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