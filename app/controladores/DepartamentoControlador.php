<?php
session_start();

if ($_SESSION["cve_usuario"] == "")
{
	header("Location:Login");
}
else
{

	//Heredamos Controlador para poder tener acceso al método modelo y método vista
	class Departamento extends Controlador
	{
		
		public function __construct()
		{

			$this->departamentoModelo = $this->modelo('DepartamentoModelo');

		}



		//Todo controlador debe tener un metodo index
		public function index()
		{
			$this->vista('departamento/Departamento');
		}



		public function consultar()
		{
			$data = $this->departamentoModelo->consultar($_POST);

			$envioDatos["arrayDatos"] = $data;

			echo json_encode($envioDatos);
		}



		public function formDepartamento()
		{

			$this->vista('departamento/formDepartamento', $datos);
		}



		public function guardarDepartamento()
		{
			$datosCompletos = $this->validarDatosVaciosDepartamentoGuardar($_POST);

			if ($datosCompletos == "vacio")
			{
				$status = "error";
				$msg = "Favor de revisar el formulario, hay campos requeridos vacios.";
			}
			else
			{
				//Preparamos en un array los datos que enviaremos a la BD
				$cve_departamento = (empty($cve_departamento)) ? $_POST["txtcveDepartamento"] : 0 ;

				$datosDepartamento =  array (
									ban                => 1,
									nombreDepartamento => $_POST["txtNombreDepartamento"],
									cve_departamento   => $cve_departamento,
							     	cveusuario_accion  => $_SESSION["cve_usuario"]
							     );
				
				$respuesta = $this->departamentoModelo->guardarDepartamento($datosDepartamento);

				
				if ($respuesta == true)
				{
					$msg = "Departamento guardado con Éxito.";
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



		public function validarDatosVaciosDepartamentoGuardar($dataPost)
		{
			if(empty($dataPost["txtNombreDepartamento"]) || !trim($dataPost["txtNombreDepartamento"])){ $status = "vacio"; }
			else{
				$status = "completo";
			}

			return $status;
		}



		public function bloquearDepartamento()
		{
			$datosDepartamento =  array (
								ban                => $_POST["ban"],
								cve_departamento   => $_POST["cve_departamento"],
								cveusuario_accion  => $_SESSION["cve_usuario"]
						     );

			$respuesta = $this->departamentoModelo->bloquearDepartamento($datosDepartamento);

			if ($respuesta == true)
			{
				if ($datosDepartamento['ban'] == 2)
				{
					$msg = "Departamento bloqueado.";
				}else{
					$msg = "Departamento desbloqueado.";
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