<?php

class PuestoModelo
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
        $cve_puesto = (!empty($datosFiltrados['cve_puesto']) || $datosFiltrados['cve_puesto']!=null) ? $datosFiltrados['cve_puesto'] : '0';

        $query = "CALL obtenPuestos('$ban','$cve_puesto')";

        $c_puesto = $this->conexion->query($query);
        $r_puesto = $this->conexion->consulta_array($c_puesto);

        return $r_puesto;
    }



    public function guardarPuesto($datosPuesto)
    {

        $datosFiltrados = $this->filtrarDatos($datosPuesto);

        $ban               = $datosFiltrados['ban'];
        $nombrePuesto      = $datosFiltrados['nombrePuesto'];
        $cvePuesto         = $datosFiltrados['cve_puesto'];
        $cveusuario_accion = $datosFiltrados['cveusuario_accion'];

        $query = "CALL guardarPuesto(
                                    '$ban',
                                    '$cvePuesto',
                                    '$nombrePuesto',
                                    '$cveusuario_accion'
                                    )";

        $respuesta = $this->conexion->query($query) or die ($this->conexion->error());
        
        $this->conexion->close_conexion();
        
        return $respuesta;

    }



    public function bloquearPuesto($datosPuesto)
    {
        $datosFiltrados = $this->filtrarDatos($datosPuesto);

        $ban               = $datosFiltrados['ban'];
        $cve_puesto        = $datosFiltrados['cve_puesto'];
        $cveusuario_accion = $datosFiltrados['cveusuario_accion'];

        $query = "CALL eliminarPuesto('$ban','$cve_puesto','$cveusuario_accion')";

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