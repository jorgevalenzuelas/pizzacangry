<?php
session_start();

if ($_SESSION["cve_usuario"] == "")
{
	header("Location:Login");
}
else
{

	//Heredamos Controlador para poder tener acceso al método modelo y método vista
	class Producto extends Controlador
	{
		
		public function __construct()
		{

			$this->productoModelo = $this->modelo('ProductoModelo');

		}



		//Todo controlador debe tener un metodo index
		public function index()
		{
			$this->vista('producto/Producto');
		}



		public function consultar()
		{
			$data = $this->productoModelo->consultar($_POST);

			$envioDatos["arrayDatos"] = $data;

			echo json_encode($envioDatos);
		}



		public function guardarProducto()
		{
			$datosCompletos = $this->validarDatosVaciosProductoGuardar($_POST);

			if ($datosCompletos == "vacio")
			{
				$status = "error";
				$msg = "Favor de revisar el formulario, hay campos requeridos vacios.";
			}
			else
			{
				//Validación de datos para insertar en la BD
				$cve_producto = (empty($cve_producto)) ? $_POST["txtcveProducto"] : 0 ;
				$precioVenta = $_POST["txtCosto"] + $_POST["txtUtilidad"];

				//Preparamos en un array los datos que enviaremos a la BD
				$datosProducto =  array (
									ban                 => 1,
									codigoLocal         => $_POST["txtCodigoLocal"],
									codigoBarra         => $_POST["txtCodigoBarra"],
									nombreProducto      => $_POST["txtNombreProducto"],
									descripcionProducto => $_POST["txtDescripcion"],
									modeloProducto      => $_POST["txtModelo"],
									tipoUnidadProducto  => $_POST["cmbTipoUnidad"],
									categoriaProducto   => $_POST["cmbCategoria"],
									costoProducto       => $_POST["txtCosto"],
									utilidadProducto    => $_POST["txtUtilidad"],
									precioVentaProducto => $precioVenta ,
									cve_producto        => $cve_producto,
							     	cveusuario_accion   => $_SESSION["cve_usuario"]
							     );

				$respuesta = $this->productoModelo->guardarProducto($datosProducto);
				
				if ($respuesta == 0)
				{
					$msg = "Producto guardado con Éxito.";
					$status = "success";
				}
				elseif ($respuesta == 1)
				{
					$msg = "El código de Barras ya existe.";
					$status = "error";
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



		public function validarDatosVaciosProductoGuardar($dataPost)
		{
			//print_r($dataPost);
			if($dataPost["txtCodigoLocal"] == "" || !trim($dataPost["txtCodigoLocal"])){ $status = "vacio"; }
			elseif($dataPost["txtNombreProducto"] == "" || !trim($dataPost["txtNombreProducto"])){ $status = "vacio"; }
			elseif($dataPost["cmbTipoUnidad"] == -1){ $status = "vacio"; }
			elseif($dataPost["cmbCategoria"] == -1 ){ $status = "vacio"; }
			elseif($dataPost["txtCosto"] == "" || !trim($dataPost["txtCosto"])){ $status = "vacio"; }
			elseif($dataPost["txtUtilidad"] == "" || !trim($dataPost["txtUtilidad"])){ $status = "vacio"; }
			elseif($dataPost["txtPrecioVenta"] == "" || !trim($dataPost["txtPrecioVenta"])){ $status = "vacio"; }
			else{
				$status = "completo";
			}

			return $status;
		}



		public function bloquearProducto()
		{
			$datosProducto =  array (
								ban                => $_POST["ban"],
								cve_producto       => $_POST["cve_producto"],
								cveusuario_accion  => $_SESSION["cve_usuario"]
						     );

			$respuesta = $this->productoModelo->bloquearEliminarProducto($datosProducto);

			if ($respuesta == true)
			{
				if ($datosProducto['ban'] == 2)
				{
					$msg = "Producto bloqueado.";
				}else{
					$msg = "Producto desbloqueado.";
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

		public function eliminarProducto()
		{
			$datosProducto =  array (
								ban                => $_POST["ban"],
								cve_producto       => $_POST["cve_producto"],
								cveusuario_accion  => $_SESSION["cve_usuario"]
						     );

			$respuesta = $this->productoModelo->bloquearEliminarProducto($datosProducto);

			if ($respuesta == true)
			{
				$msg = "Producto Eliminado.";
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