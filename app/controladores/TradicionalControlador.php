<?php
session_start();

if ($_SESSION["cve_usuario"] == "")
{
	header("Location:Login");
}
else
{

	//Heredamos Controlador para poder tener acceso al método modelo y método vista
	class Tradicional extends Controlador
	{
		
		public function __construct()
		{

			$this->TradicionalModelo = $this->modelo('TradicionalModelo');

		}



		//Todo controlador debe tener un metodo index
		public function index()
		{
			$this->vista('tradicional/Tradicional');
		}



		public function consultar()
		{
			$data = $this->TradicionalModelo->consultar($_POST);

			$envioDatos["arrayDatos"] = $data;

			echo json_encode($envioDatos);
		}

		public function guardarTradicional()
		{
			$datosCompletos = $this->validarDatosVaciosTradicionalGuardar($_POST);
			if ($datosCompletos == "vacio")
			{
				$status = "error";
				$msg = "Favor de revisar el formulario, hay campos requeridos vacios.";
			}
			else
			{
				//Preparamos en un array los datos que enviaremos a la BD
				$cve_tradicional = (empty($cve_tradicional)) ? $_POST["cve_tradicional"] : 0 ;
				$datosTradicional =  array (
									ban                => 1,
									cve_tradicional   => $cve_tradicional,
									nombre_tradicional => $_POST["nombre_tradicional"],
									costo_tradicional => $_POST["costo_tradicional"],
									precio_tradicional => $_POST["precio_tradicional"],
									cantidadingrediente_tradicional => $_POST["cantidadingrediente_tradicional"],
									cvetamano_tradicional => $_POST["cvetamano_tradicional"],
							     	cveusuario_accion  => $_SESSION["cve_usuario"]
							     );
				
				$respuesta = $this->TradicionalModelo->guardarTradicional($datosTradicional);

				
				if ($respuesta == true)
				{
					$msg = "Tradicional guardado con Éxito.";
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



		public function validarDatosVaciosTradicionalGuardar($dataPost)
		{
			if(empty($dataPost["nombre_tradicional"]) || !trim($dataPost["nombre_tradicional"])){ $status = "vacio"; }
			else if(empty($dataPost["costo_tradicional"]) || !trim($dataPost["costo_tradicional"])){ $status = "vacio"; }
			else if(empty($dataPost["precio_tradicional"]) || !trim($dataPost["precio_tradicional"])){ $status = "vacio"; }
			else if(empty($dataPost["cantidadingrediente_tradicional"]) || !trim($dataPost["cantidadingrediente_tradicional"])){ $status = "vacio"; }
			else if(empty($dataPost["cvetamano_tradicional"]) || !trim($dataPost["cvetamano_tradicional"])){ $status = "vacio"; }
			else{
				$status = "completo";
			}

			return $status;
		}



		public function bloquearTradicional()
		{
			$datosTradicional =  array (
								ban                => $_POST["ban"],
								cve_tradicional   => $_POST["cve_tradicional"],
								cveusuario_accion  => $_SESSION["cve_usuario"]
						     );

			$respuesta = $this->TradicionalModelo->bloquearTradicional($datosTradicional);

			if ($respuesta == true)
			{
				if ($datosTradicional['ban'] == 2)
				{
					$msg = "Tradicional bloqueado.";
				}else{
					$msg = "Tradicional desbloqueado.";
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