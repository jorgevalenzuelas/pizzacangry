<?php
session_start();

if ($_SESSION["cve_usuario"] == "")
{
	header("Location:Login");
}
else
{

	//Heredamos Controlador para poder tener acceso al método modelo y método vista
	class Usuario extends Controlador
	{
		
		public function __construct()
		{

			$this->usuarioModelo = $this->modelo('UsuarioModelo');

		}



		//Todo controlador debe tener un metodo index
		public function index()
		{
			$this->vista('usuario/Usuario');
		}



		public function consultar()
		{
			$data = $this->usuarioModelo->consultar($_POST);

			$envioDatos["arrayDatos"] = $data;

			echo json_encode($envioDatos);
		}



		public function registrarUsuario()
		{
			$datosCompletos = $this->validarDatosVaciosUsuarioRegistro($_POST);

			if ($datosCompletos == "vacio")
			{
				$status = "error";
				$msg = "Favor de revisar el formulario, hay campos requeridos vacios.";
			}
			else
			{
				//Preparamos en un array los datos que enviaremos a la BD
				$cve_usuario = (empty($cve_usuario)) ? $_POST["txtcveUsuario"] : 0 ;

				$datosUsuario =  array (
									ban                 => 1,
									cve_usuario         => $cve_usuario,
									nombre_usuario      => $_POST["txtNombreUsuario"],
								  	apellidop_usuario   => $_POST["txtApellidoPaterno"],
							      	apellidom_usuario   => $_POST["txtApellidoMaterno"],
							     	login_usuario       => $_POST["txtLogin"],
							     	password_usuario    => $_POST["txtPass"],
							     	perfil_usuario      => $_POST["cmbPerfil"],
							     	sucursal            => $_POST["cmbSucursal"],
							     	puesto              => $_POST["cmbPuesto"],
							     	cveusuario_accion   => $_SESSION["cve_usuario"]
							     );

				$respuesta = $this->usuarioModelo->registrarUsuario($datosUsuario);

				
				if ($respuesta == true)
				{
					$msg = "Usuario guardado con Éxito.";
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



		public function validarDatosVaciosUsuarioRegistro($dataPost)
		{

			if($dataPost["txtNombreUsuario"] == "" || !trim($dataPost["txtNombreUsuario"]) ){ $status = "vacio"; }
			elseif($dataPost["txtApellidoPaterno"] == "" || !trim($dataPost["txtApellidoPaterno"]) ){ $status = "vacio"; }
			elseif($dataPost["txtApellidoMaterno"] == "" || !trim($dataPost["txtApellidoMaterno"]) ){ $status = "vacio"; }
			elseif($dataPost["txtLogin"] == "" || !trim($dataPost["txtLogin"]) ){ $status = "vacio"; }
			elseif($dataPost["txtAccion"] == "A" && $dataPost["txtPass"] == ""){ $status = "vacio"; }
			elseif($dataPost["cmbPerfil"] == -1){ $status = "vacio"; }
			elseif($dataPost["cmbSucursal"] == -1 && $dataPost["cmbPerfil"] <> 1){ $status = "vacio"; }
			elseif($dataPost["cmbPuesto"] == -1){ $status = "vacio"; }
			else{
				$status = "completo";
			}

			return $status;
		}

		

		public function bloquearUsuario()
		{
			$datosUsuario =  array (
								ban                 => $_POST["ban"],
								cve_usuario         => $_POST["cve_usuario"],
								cveusuario_accion   => $_SESSION["cve_usuario"]
						     );

			$respuesta = $this->usuarioModelo->bloquearUsuario($datosUsuario);

			if ($respuesta == true)
			{
				if ($datosUsuario['ban'] == 2)
				{
					$msg = "Usuario bloqueado.";
				}else{
					$msg = "Usuario desbloqueado.";
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