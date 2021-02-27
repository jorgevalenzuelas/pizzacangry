<?php
class TamanoModelo
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
        $cve_tamano = (!empty($datosFiltrados['cve_tamano']) || $datosFiltrados['cve_tamano']!=null) ? $datosFiltrados['cve_tamano'] : '0';

        $query = "CALL obtenTamano('$ban','$cve_tamano')";

        $c_tamano = $this->conexion->query($query);
        $r_tamano = $this->conexion->consulta_array($c_tamano);

        return $r_tamano;
    }

    public function guardarTamano($datosTamano)
    {
        $datosFiltrados = $this->filtrarDatos($datosTamano);

        $ban                = $datosFiltrados['ban'];
        $cve_tamano    = $datosFiltrados['cve_tamano'];
        $nombre_tamano = $datosFiltrados['nombre_tamano'];

        $query = "CALL guardarTamano(
                                            '$ban',
                                            '$cve_tamano',
                                            '$nombre_tamano'
                                        )";

        $respuesta = $this->conexion->query($query) or die ($this->conexion->error());
        
        $this->conexion->close_conexion();
        
        return $respuesta;

    }

    public function bloquearTamano($datosTamano)
    {
        $datosFiltrados = $this->filtrarDatos($datosTamano);

        $ban               = $datosFiltrados['ban'];
        $cve_tamano  = $datosFiltrados['cve_tamano'];

        $query = "CALL eliminarTamano('$ban','$cve_tamano')";

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