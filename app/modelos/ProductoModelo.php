<?php

class ProductoModelo
{

	//creamos la variable donde se instanciará la clase "conectar"
    public $conexion;

    public function __construct() {

    	//inicializamos la clase para conectarnos a la bd
        $this->conexion = new ConexionBD(); //instanciamos la clase

    }



    public function consultar($datos)
    {
        $datosFiltrados = $this->filtrarDatos($datos);

        $ban  = $datosFiltrados['ban'];
        $cve_producto = (!empty($datosFiltrados['cve_producto']) || $datosFiltrados['cve_producto']!=null) ? $datosFiltrados['cve_producto'] : '';
        $codigoBarra  = $datosFiltrados['codigoBarra'];

        $query = "CALL obtenProductos('$ban','$cve_producto','$codigoBarra')";

        $c_producto = $this->conexion->query($query);
        $r_producto = $this->conexion->consulta_array($c_producto);

        return $r_producto;
    }



    public function guardarProducto($datosProducto)
    {

        $datosFiltrados = $this->filtrarDatos($datosProducto);

        $ban                 = $datosFiltrados['ban'];
        $codigoLocal         = $datosFiltrados['codigoLocal'];
        $codigoBarra         = $datosFiltrados['codigoBarra'];
        $nombreProducto      = $datosFiltrados['nombreProducto'];
        $descripcionProducto = $datosFiltrados['descripcionProducto'];
        $tipoUnidadProducto  = $datosFiltrados['tipoUnidadProducto'];
        $categoriaProducto   = $datosFiltrados['categoriaProducto'];
        //$costoProducto       = $datosFiltrados['costoProducto'];
        $costoProducto       = (!empty($datosFiltrados['costoProducto']) ) ? $datosFiltrados['costoProducto'] : 0;
        //$utilidadProducto    = $datosFiltrados['utilidadProducto'];
        $utilidadProducto    = (!empty($datosFiltrados['utilidadProducto']) ) ? $datosFiltrados['utilidadProducto'] : 0;
        //$precioVentaProducto = $datosFiltrados['precioVentaProducto'];
        $precioVentaProducto = (!empty($datosFiltrados['precioVentaProducto']) ) ? $datosFiltrados['precioVentaProducto'] : 0;
        $cveProducto         = $datosFiltrados['cve_producto'];
        $cveusuario_accion   = $datosFiltrados['cveusuario_accion'];

        $query = "CALL guardarProducto(
                                    '$ban',
                                    '$cveProducto',
                                    '$codigoLocal',
                                    '$codigoBarra',
                                    '$nombreProducto',
                                    '$descripcionProducto',
                                    '$tipoUnidadProducto',
                                    '$categoriaProducto',
                                    '$costoProducto',
                                    '$utilidadProducto',
                                    '$precioVentaProducto',
                                    '$cveusuario_accion'
                                    )";


        $respuesta = $this->conexion->query($query) or die ($this->conexion->error());
        $r_producto = $this->conexion->consulta_array($respuesta);
        
        $this->conexion->close_conexion();
        
        return $r_producto[0][existe];

    }



    public function bloquearEliminarProducto($datosProducto)
    {
        $datosFiltrados = $this->filtrarDatos($datosProducto);

        $ban               = $datosFiltrados['ban'];
        $cve_producto      = $datosFiltrados['cve_producto'];
        $cveusuario_accion = $datosFiltrados['cveusuario_accion'];

        $query = "CALL eliminarProducto('$ban','$cve_producto','$cveusuario_accion')";

        $respuesta = $this->conexion->query($query);

        return $respuesta;
    }

    

    public function filtrarDatos($datosFiltrar){

        foreach ($datosFiltrar as $indice => $valor) {
            $datosFiltrarr[$indice] = $this->conexion->real_escape_string($valor);
        }

        return $datosFiltrarr;

    }
	
}

?>