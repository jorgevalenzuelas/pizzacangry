<?php
session_start();

if ($_SESSION["cve_usuario"] == "")
{
	header("Location:Login");
}
else
{

	//Heredamos Controlador para poder tener acceso al método modelo y método vista
	class Categoria extends Controlador
	{
		
		public function __construct()
		{

			$this->categoriaModelo = $this->modelo('CategoriaModelo');

		}



		//Todo controlador debe tener un metodo index
		public function index()
		{
			$this->vista('categoria/Categoria');
		}



		public function consultar()
		{
			$data = $this->categoriaModelo->consultar($_POST);

			$envioDatos["arrayDatos"] = $data;

			echo json_encode($envioDatos);
		}


		/*
		public function formCategoria()
		{

			$this->vista('categoria/formCategoria', $datos);
		}
		*/


		public function guardarCategoria()
		{
			$datosCompletos = $this->validarDatosVaciosCategoriaGuardar($_POST);

			if ($datosCompletos == "vacio")
			{
				$status = "error";
				$msg = "Favor de revisar el formulario, hay campos requeridos vacios.";
			}
			else
			{
				//Preparamos en un array los datos que enviaremos a la BD
				$cve_categoria = (empty($cve_categoria)) ? $_POST["txtcveCategoria"] : 0 ;

				$datosCategoria =  array (
									ban                => 1,
									cvedepartamento    => $_POST["cmbDepartamento"],
									nombreCategoria    => $_POST["txtNombreCategoria"],
									cve_categoria      => $cve_categoria,
							     	cveusuario_accion  => $_SESSION["cve_usuario"]
							     );
				
				$respuesta = $this->categoriaModelo->guardarCategoria($datosCategoria);

				
				if ($respuesta == true)
				{
					$msg = "Categoría guardada con Éxito.";
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



		public function validarDatosVaciosCategoriaGuardar($dataPost)
		{
			if(empty($dataPost["txtNombreCategoria"]) || !trim($dataPost["txtNombreCategoria"])){ $status = "vacio"; }
			elseif($dataPost["cmbDepartamento"] == -1 || !trim($dataPost["cmbDepartamento"])){ $status = "vacio"; }
			else{
				$status = "completo";
			}

			return $status;
		}



		public function bloquearCategoria()
		{
			$datosCategoria =  array (
								ban                => $_POST["ban"],
								cve_categoria      => $_POST["cve_categoria"],
								cveusuario_accion  => $_SESSION["cve_usuario"]
						     );

			$respuesta = $this->categoriaModelo->bloquearCategoria($datosCategoria);

			if ($respuesta == true)
			{
				if ($datosCategoria['ban'] == 2)
				{
					$msg = "Categoría bloqueada.";
				}else{
					$msg = "Categoría desbloqueada.";
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