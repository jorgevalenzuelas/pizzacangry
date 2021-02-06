<?php
session_start();

if ($_SESSION["cve_usuario"] == "")
{
	header("Location:Login");
}
else
{

	//Heredamos Controlador para poder tener acceso al método modelo y método vista
	class Ingrediente extends Controlador
	{
		
		public function __construct()
		{

			$this->IngredienteModelo = $this->modelo('IngredienteModelo');

		}



		//Todo controlador debe tener un metodo index
		public function index()
		{
			$this->vista('ingrediente/Ingrediente');
		}



		public function consultar()
		{
			$data = $this->IngredienteModelo->consultar($_POST);

			$envioDatos["arrayDatos"] = $data;

			echo json_encode($envioDatos);
		}

		public function guardarIngrediente()
		{
			$datosCompletos = $this->validarDatosVaciosIngredienteGuardar($_POST);
			if ($datosCompletos == "vacio")
			{
				$status = "error";
				$msg = "Favor de revisar el formulario, hay campos requeridos vacios.";
			}
			else
			{
				//Preparamos en un array los datos que enviaremos a la BD
				$cve_ingrediente = (empty($cve_ingrediente)) ? $_POST["cve_ingrediente"] : 0 ;
				$datosIngrediente =  array (
									ban                => 1,
									cve_ingrediente   => $cve_ingrediente,
									nombre_ingrediente => $_POST["nombre_ingrediente"],
							     	cveusuario_accion  => $_SESSION["cve_usuario"]
							     );
				
				$respuesta = $this->IngredienteModelo->guardarIngrediente($datosIngrediente);

				
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



		public function validarDatosVaciosIngredienteGuardar($dataPost)
		{
			if(empty($dataPost["nombre_ingrediente"]) || !trim($dataPost["nombre_ingrediente"])){ $status = "vacio"; }
			else{
				$status = "completo";
			}

			return $status;
		}



		public function bloquearIngrediente()
		{
			$datosIngrediente =  array (
								ban                => $_POST["ban"],
								cve_ingrediente   => $_POST["cve_ingrediente"],
								cveusuario_accion  => $_SESSION["cve_usuario"]
						     );

			$respuesta = $this->IngredienteModelo->bloquearIngrediente($datosIngrediente);

			if ($respuesta == true)
			{
				if ($datosIngrediente['ban'] == 2)
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