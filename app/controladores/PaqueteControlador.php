<?php
session_start();

if ($_SESSION["cve_usuario"] == "")
{
	header("Location:Login");
}
else
{

	//Heredamos Controlador para poder tener acceso al método modelo y método vista
	class Paquete extends Controlador
	{
		
		public function __construct()
		{

			$this->PaqueteModelo = $this->modelo('PaqueteModelo');

		}



		//Todo controlador debe tener un metodo index
		public function index()
		{
			$this->vista('paquete/Paquete');
		}



		public function consultar()
		{
			$data = $this->PaqueteModelo->consultar($_POST);

			$envioDatos["arrayDatos"] = $data;

			echo json_encode($envioDatos);
		}

		public function consultarDetallePaquete()
		{
			$data = $this->PaqueteModelo->consultarDetallePaquete($_POST);

			$envioDatos["arrayDatos"] = $data;

			echo json_encode($envioDatos);
		}

		public function guardarPaquete()
		{
			$datosCompletos = $this->validarDatosVaciosPaqueteGuardar($_POST);
			if ($datosCompletos == "vacio")
			{
				$status = "error";
				$msg = "Favor de revisar el formulario, hay campos requeridos vacios.";
			}
			else
			{
				//Preparamos en un array los datos que enviaremos a la BD
				$cve_paquete = (empty($cve_paquete)) ? $_POST["cve_paquete"] : 0 ;
				$datosPaquete =  array (
									ban                => 1,
									cve_paquete   => $cve_paquete,
									nombre_paquete => $_POST["nombre_paquete"],
									costo_paquete => $_POST["costo_paquete"],
									precio_paquete => $_POST["precio_paquete"],
							     	cveusuario_accion  => $_SESSION["cve_usuario"]
							     );
				
				$respuesta = $this->PaqueteModelo->guardarPaquete($datosPaquete);

				
				if ($respuesta == true)
				{
					$msg = "Paquete guardado con Éxito.";
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

		public function guardarDetallePaquete()
		{
			$datosCompletos = $this->validarDatosVaciosDetallePaqueteGuardar($_POST);
			if ($datosCompletos == "vacio")
			{
				$status = "error";
				$msg = "Favor de revisar el formulario, hay campos requeridos vacios.";
			}
			else
			{
				//Preparamos en un array los datos que enviaremos a la BD
				$cve_paquete = (empty($cve_paquete)) ? $_POST["cve_paquete"] : 0 ;
				$cvepaquete_depaquete = (empty($cvepaquete_depaquete)) ? $_POST["cvepaquete_depaquete"] : 0 ;
				$datosDetallePaquete =  array (
									ban                => 1,
									cve_paquete   => $cve_paquete,
									cvepaquete_depaquete	=> $cvepaquete_depaquete,
									cvema_depaquete => $_POST["cvema_depaquete"],
									cantidad_depaquete => $_POST["cantidad_depaquete"],
									cveproducto_depaquete => $_POST["cveproducto_depaquete"],
							     	cveusuario_accion  => $_SESSION["cve_usuario"]
							     );
				
				$respuesta = $this->PaqueteModelo->guardarDetallePaquete($datosDetallePaquete);

				
				if ($respuesta == true)
				{
					$msg = "Detalle de paquete guardado con Éxito.";
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



		public function validarDatosVaciosPaqueteGuardar($dataPost)
		{
			if(empty($dataPost["nombre_paquete"]) || !trim($dataPost["nombre_paquete"])){ $status = "vacio"; }
			else if(empty($dataPost["costo_paquete"]) || !trim($dataPost["costo_paquete"])){ $status = "vacio"; }
			else if(empty($dataPost["precio_paquete"]) || !trim($dataPost["precio_paquete"])){ $status = "vacio"; }
			else{
				$status = "completo";
			}

			return $status;
		}

		public function validarDatosVaciosDetallePaqueteGuardar($dataPost)
		{
			if(empty($dataPost["cvema_depaquete"]) || !trim($dataPost["cvema_depaquete"])){ $status = "vacio"; }
			else if(empty($dataPost["cantidad_depaquete"]) || !trim($dataPost["cantidad_depaquete"])){ $status = "vacio"; }
			else{
				$status = "completo";
			}

			return $status;
		}

		public function bloquearPaquete()
		{
			$datosPaquete =  array (
								ban                => $_POST["ban"],
								cve_paquete   => $_POST["cve_paquete"],
								cveusuario_accion  => $_SESSION["cve_usuario"]
						     );

			$respuesta = $this->PaqueteModelo->bloquearPaquete($datosPaquete);

			if ($respuesta == true)
			{
				if ($datosPaquete['ban'] == 2)
				{
					$msg = "Paquete bloqueado.";
				}else{
					$msg = "Paquete desbloqueado.";
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