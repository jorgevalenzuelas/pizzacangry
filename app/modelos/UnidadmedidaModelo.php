<?php

class UnidadmedidaModelo
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
        $cve_unidadmedida = (!empty($datosFiltrados['cve_unidadmedida']) || $datosFiltrados['cve_unidadmedida']!=null) ? $datosFiltrados['cve_unidadmedida'] : '0';

        $query = "CALL obtenUnidadmedida('$ban','$cve_unidadmedida')";

        $c_unidadmedida = $this->conexion->query($query);
        $r_unidadmedida = $this->conexion->consulta_array($c_unidadmedida);

        return $r_unidadmedida;
    }



    public function guardarUnidadmedida($datosUnidadmedida)
    {

        $datosFiltrados = $this->filtrarDatos($datosUnidadmedida);

        $ban                = $datosFiltrados['ban'];
        $cve_unidadmedida    = $datosFiltrados['cve_unidadmedida'];
        $nombre_unidadmedida = $datosFiltrados['nombre_unidadmedida'];

        $query = "CALL guardarUnidadmedida(
                                            '$ban',
                                            '$cve_unidadmedida',
                                            '$nombre_unidadmedida'
                                        )";

        $respuesta = $this->conexion->query($query) or die ($this->conexion->error());
        
        $this->conexion->close_conexion();
        
        return $respuesta;

    }



    public function bloquearUnidadmedida($datosUnidadmedida)
    {
        $datosFiltrados = $this->filtrarDatos($datosUnidadmedida);

        $ban               = $datosFiltrados['ban'];
        $cve_unidadmedida  = $datosFiltrados['cve_unidadmedida'];

        $query = "CALL eliminarUnidadmedida('$ban','$cve_unidadmedida')";

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