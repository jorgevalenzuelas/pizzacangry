<?php

class TradicionalModelo
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
        $cve_tradicional = (!empty($datosFiltrados['cve_tradicional']) || $datosFiltrados['cve_tradicional']!=null) ? $datosFiltrados['cve_tradicional'] : '0';

        $query = "CALL obtenTradicional('$ban','$cve_tradicional')";

        $c_departamento = $this->conexion->query($query);
        $r_departamento = $this->conexion->consulta_array($c_departamento);

        return $r_departamento;
    }



    public function guardarTradicional($datosTradicional)
    {

        $datosFiltrados = $this->filtrarDatos($datosTradicional);

        $ban                = $datosFiltrados['ban'];
        $cve_tradicional    = $datosFiltrados['cve_tradicional'];
        $nombre_tradicional = $datosFiltrados['nombre_tradicional'];
        $costo_tradicional = $datosFiltrados['costo_tradicional'];
        $precio_tradicional = $datosFiltrados['precio_tradicional'];
        $cantidadingrediente_tradicional = $datosFiltrados['cantidadingrediente_tradicional'];
        $cvetamano_tradicional = $datosFiltrados['cvetamano_tradicional'];
        $cveusuario_accion  = $datosFiltrados['cveusuario_accion'];

        $query = "CALL guardarTradicional(
                                            '$ban',
                                            '$cve_tradicional',
                                            '$nombre_tradicional',
                                            '$costo_tradicional',
                                            '$precio_tradicional',
                                            '$cantidadingrediente_tradicional',
                                            '$cvetamano_tradicional',
                                            '$cveusuario_accion'
                                        )";

        $respuesta = $this->conexion->query($query) or die ($this->conexion->error());
        
        $this->conexion->close_conexion();
        
        return $respuesta;

    }



    public function bloquearTradicional($datosTradicional)
    {
        $datosFiltrados = $this->filtrarDatos($datosTradicional);

        $ban               = $datosFiltrados['ban'];
        $cve_tradicional  = $datosFiltrados['cve_tradicional'];
        $cveusuario_accion = $datosFiltrados['cveusuario_accion'];

        $query = "CALL eliminarTradicional('$ban','$cve_tradicional','$cveusuario_accion')";

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