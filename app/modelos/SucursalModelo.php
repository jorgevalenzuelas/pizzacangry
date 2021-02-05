<?php

class SucursalModelo
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
        $cve_sucursal = (!empty($datosFiltrados['cve_sucursal']) || $datosFiltrados['cve_sucursal']!=null) ? $datosFiltrados['cve_sucursal'] : '0';

        $query = "CALL obtenSucursales('$ban','$cve_sucursal')";
        //echo $query;

        $c_sucursal = $this->conexion->query($query);
        $r_sucursal = $this->conexion->consulta_array($c_sucursal);

        return $r_sucursal;
    }



    public function guardarSucursal($datosSucursal)
    {

        $datosFiltrados = $this->filtrarDatos($datosSucursal);

        $ban                    = $datosFiltrados['ban'];
        $nombreSucursal         = $datosFiltrados['nombreSucursal'];
        $direccionSucursal      = $datosFiltrados['direccionSucursal'];
        $coloniaSucursal        = $datosFiltrados['coloniaSucursal'];
        $telefonoSucursal       = $datosFiltrados['telefonoSucursal'];
        $representanteSucursal  = $datosFiltrados['representanteSucursal'];
        $tipoSucursal           = $datosFiltrados['tipoSucursal'];
        $cveSucursal            = $datosFiltrados['cve_sucursal'];
        $cveusuario_accion      = $datosFiltrados['cveusuario_accion'];

        $query = "CALL guardarSucursal(
                                    '$ban',
                                    '$cveSucursal',
                                    '$nombreSucursal',
                                    '$direccionSucursal',
                                    '$coloniaSucursal',
                                    '$telefonoSucursal',
                                    '$representanteSucursal',
                                    '$tipoSucursal',
                                    '$cveusuario_accion'
                                    )";

        $respuesta = $this->conexion->query($query) or die ($this->conexion->error());
        
        $this->conexion->close_conexion();
        
        return $respuesta;

    }



    public function bloquearSucursal($datosSucursal)
    {
        $datosFiltrados = $this->filtrarDatos($datosSucursal);

        $ban               = $datosFiltrados['ban'];
        $cve_sucursal        = $datosFiltrados['cve_sucursal'];
        $cveusuario_accion = $datosFiltrados['cveusuario_accion'];

        $query = "CALL eliminarSucursal('$ban','$cve_sucursal','$cveusuario_accion')";

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