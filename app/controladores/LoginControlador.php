<?php


//Heredamos Controlador para poder tener acceso al método modelo y método vista
class Login extends Controlador
{
	
	public function __construct()
	{

		$this->loginModelo = $this->modelo('LoginModelo');

	}

	//Todo controlador debe tener un metodo index
	public function index()
	{
		$this->vista('login/Login');
	}

	public function verificarUsuario()
	{

		$data = $this->loginModelo->obtenerUsuario($_POST);
		
		if ($data[0]['total_rows'] > 0)
		{
			$sesion = $this->iniciaSesion($data);
		}
		else
		{
			$msg = "La contraseña no pertenece a ningun usuario.";
			$sesion = 0;
		}

		$envio_datos["sesion"] = $sesion;
		$envio_datos["msg"] = $msg;

		echo json_encode($envio_datos);
		
	}

	public function iniciaSesion($data)
	{
		session_start();

		$_SESSION["cve_usuario"]       = $data[0]['cve_usuario'];
		$_SESSION["login_usuario"]     = $data[0]['login_usuario'];
		$_SESSION["cveperfil_usuario"] = $data[0]["cveperfil_usuario"];
		$_SESSION["nombreUsuario"]     = $data[0]["nombreCompleto"];

		$_SESSION["menu_perfil"]  = $this->menu_perfil($_SESSION["cveperfil_usuario"]);
		
		return 1;

	}

	public function menu_perfil($cveperfil_usuario)
	{

		$datosOpcion =  array (
								ban               => 1,
								cveperfil_usuario => $cveperfil_usuario,
								origen            => 0
						     );

		$data = $this->loginModelo->crear_menu($datosOpcion);

		return $data;
	}

	public function cerrarSesion()
	{
		session_start();
		session_unset();
		session_destroy(); 

		$envio_datos["sesion"] = 0;
		echo json_encode($envio_datos);
	}

}


?>