<?php
session_start();

if ($_SESSION["cve_usuario"] == "")
{
	header("Location:Login");
}
else
{

	//Heredamos Controlador para poder tener acceso al método modelo y método vista
	class Perfil extends Controlador
	{
		
		public function __construct()
		{

			$this->perfilModelo = $this->modelo('PerfilModelo');

		}



		//Todo controlador debe tener un metodo index
		public function index()
		{
			$this->vista('perfil/Perfil');
		}



		public function consultar()
		{
			$data = $this->perfilModelo->consultar($_POST);

			$envioDatos["arrayDatos"] = $data;

			echo json_encode($envioDatos);
		}



		public function formPerfil()
		{

			$cve_perfil = (empty($cve_perfil)) ? $_POST["cve_perfil"] : 0 ;
			$datosPerfil =  array (
									cvePerfil => $cve_perfil
							     );

			$datos = $this->perfilModelo->obtenerOpcionesMenu($datosPerfil);

			$this->vista('perfil/formPerfil', $datos);
		}



		public function guardarPerfil()
		{
			$datosCompletos = $this->validarDatosVaciosPerfilGuardar($_POST);

			if ($datosCompletos == "vacio")
			{
				$status = "error";
				$msg = "Favor de revisar el formulario, hay campos requeridos vacios.";
			}
			else
			{
				//Preparamos en un array los datos que enviaremos a la BD
				$cve_perfil = (empty($cve_perfil)) ? $_POST["txtcvePerfil"] : 0 ;

				$datosPerfil[0] =  array (
									ban               => 1,
									nombrePerfil      => $_POST["txtNombrePerfil"],
									descipcionPerfil  => $_POST["txtDescipcionPerfil"],
									cvePerfil         => $cve_perfil,
							     	cveusuario_accion => $_SESSION["cve_usuario"]
							     );

				$datosPerfil[1] = array (
									chk2_venta                => $_POST["chk2_venta"],
									chk2_reporteventa         => $_POST["chk2_reporteventa"],
									chk2_es_efectivo          => $_POST["chk2_es_efectivo"],
									chk2_pedido               => $_POST["chk2_pedido"],
									chk2_consultapedidos      => $_POST["chk2_consultapedidos"],
									chk2_historicopedidos     => $_POST["chk2_historicopedidos"],
									chk2_pastel               => $_POST["chk2_pastel"],
									chk2_consultapasteles     => $_POST["chk2_consultapasteles"],
									chk2_producto             => $_POST["chk2_producto"],
									chk2_promociones          => $_POST["chk2_promociones"],
									chk2_existenciasalmacen   => $_POST["chk2_existenciasalmacen"],
									chk2_enviosexistencias    => $_POST["chk2_enviosexistencias"],
									chk2_consultaenvios       => $_POST["chk2_consultaenvios"],
									chk2_existenciasstock     => $_POST["chk2_existenciasstock"],
									chk2_recepcionexistencias => $_POST["chk2_recepcionexistencias"],
									chk2_mermasproductos      => $_POST["chk2_mermasproductos"],
									chk2_reportesgenerales    => $_POST["chk2_reportesgenerales"],
									chk2_historialmovimiento  => $_POST["chk2_historialmovimiento"],
									chk2_corte                => $_POST["chk2_corte"],
									chk2_cliente              => $_POST["chk2_clientes"],
									chk2_bases                => $_POST["chk2_bases"],
									chk2_departamentos        => $_POST["chk2_departamentos"],
									chk2_categorias           => $_POST["chk2_categorias"],
									chk2_usuario              => $_POST["chk2_usuario"],
									chk2_perfil               => $_POST["chk2_perfil"],
									chk2_sucursal             => $_POST["chk2_sucursal"],
									chk2_puesto               => $_POST["chk2_puesto"]
							     );

				//print_r($datosPerfil[1]);
				
				$respuesta = $this->perfilModelo->guardarPerfil($datosPerfil);

				
				if ($respuesta == true)
				{
					$msg = "Perfil guardado con Éxito.";
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



		public function validarDatosVaciosPerfilGuardar($dataPost)
		{
			if(empty($dataPost["txtNombrePerfil"]) || !trim($dataPost["txtNombrePerfil"])){ $status = "vacio"; }
			elseif(empty($dataPost["txtDescipcionPerfil"]) || !trim($dataPost["txtDescipcionPerfil"])){ $status = "vacio"; }
			else{
				$status = "completo";
			}

			return $status;
		}



		public function bloquearPerfil()
		{
			$datosPerfil =  array (
								ban                 => $_POST["ban"],
								cve_perfil         => $_POST["cve_perfil"],
								cveusuario_accion   => $_SESSION["cve_usuario"]
						     );

			$respuesta = $this->perfilModelo->bloquearPerfil($datosPerfil);

			if ($respuesta == true)
			{
				if ($datosPerfil['ban'] == 2)
				{
					$msg = "Perfil bloqueado.";
				}else{
					$msg = "Perfil desbloqueado.";
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