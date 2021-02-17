<?php

class ExtraModelo
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
        $cve_extra = (!empty($datosFiltrados['cve_extra']) || $datosFiltrados['cve_extra']!=null) ? $datosFiltrados['cve_extra'] : '0';

        $query = "CALL obtenExtra('$ban','$cve_extra')";

        $c_extra = $this->conexion->query($query);
        $r_extra = $this->conexion->consulta_array($c_extra);

        return $r_extra;
    }



    public function guardarExtra($datosExtra)
    {

        $datosFiltrados = $this->filtrarDatos($datosExtra);

        $ban                = $datosFiltrados['ban'];
        $cve_extra    = $datosFiltrados['cve_extra'];
        $nombre_extra = $datosFiltrados['nombre_extra'];
        $costo_extra = $datosFiltrados['costo_extra'];
        $precio_extra = $datosFiltrados['precio_extra'];
        $cvetamano_extra = $datosFiltrados['cvetamano_extra'];

        $query = "CALL guardarExtra(
                                            '$ban',
                                            '$cve_extra',
                                            '$nombre_extra',
                                            '$costo_extra',
                                            '$precio_extra',
                                            '$cvetamano_extra'
                                        )";

        $respuesta = $this->conexion->query($query) or die ($this->conexion->error());
        
        $this->conexion->close_conexion();
        
        return $respuesta;

    }



    public function bloquearExtra($datosExtra)
    {
        $datosFiltrados = $this->filtrarDatos($datosExtra);

        $ban               = $datosFiltrados['ban'];
        $cve_extra  = $datosFiltrados['cve_extra'];

        $query = "CALL eliminarExtra('$ban','$cve_extra')";

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