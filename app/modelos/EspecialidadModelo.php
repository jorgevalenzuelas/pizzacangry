<?php

class EspecialidadModelo
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
        $cve_especialidad = (!empty($datosFiltrados['cve_especialidad']) || $datosFiltrados['cve_especialidad']!=null) ? $datosFiltrados['cve_especialidad'] : '0';

        $query = "CALL obtenEspecialidad('$ban','$cve_especialidad')";

        $c_departamento = $this->conexion->query($query);
        $r_departamento = $this->conexion->consulta_array($c_departamento);

        return $r_departamento;
    }



    public function guardarEspecialidad($datosEspecialidad)
    {

        $datosFiltrados = $this->filtrarDatos($datosEspecialidad);

        $ban                = $datosFiltrados['ban'];
        $cve_especialidad    = $datosFiltrados['cve_especialidad'];
        $nombre_especialidad = $datosFiltrados['nombre_especialidad'];
        $costo_especialidad = $datosFiltrados['costo_especialidad'];
        $precio_especialidad = $datosFiltrados['precio_especialidad'];
        $descripcion_especialidad = $datosFiltrados['descripcion_especialidad'];
        $cvetamano_especialidad = $datosFiltrados['cvetamano_especialidad'];
        $cveusuario_accion  = $datosFiltrados['cveusuario_accion'];

        $query = "CALL guardarEspecialidad(
                                            '$ban',
                                            '$cve_especialidad',
                                            '$nombre_especialidad',
                                            '$costo_especialidad',
                                            '$precio_especialidad',
                                            '$descripcion_especialidad',
                                            '$cvetamano_especialidad',
                                            '$cveusuario_accion'
                                        )";

        $respuesta = $this->conexion->query($query) or die ($this->conexion->error());
        
        $this->conexion->close_conexion();
        
        return $respuesta;

    }



    public function bloquearEspecialidad($datosEspecialidad)
    {
        $datosFiltrados = $this->filtrarDatos($datosEspecialidad);

        $ban               = $datosFiltrados['ban'];
        $cve_especialidad  = $datosFiltrados['cve_especialidad'];
        $cveusuario_accion = $datosFiltrados['cveusuario_accion'];

        $query = "CALL eliminarEspecialidad('$ban','$cve_especialidad','$cveusuario_accion')";

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